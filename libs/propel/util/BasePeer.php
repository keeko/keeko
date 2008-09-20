<?php
/*
 *  $Id: BasePeer.php 847 2007-12-02 21:34:59Z heltem $
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the LGPL. For more information please see
 * <http://propel.phpdb.org>.
 */

/**
 * This is a utility class for all generated Peer classes in the system.
 *
 * Peer classes are responsible for isolating all of the database access
 * for a specific business object.  They execute all of the SQL
 * against the database.  Over time this class has grown to include
 * utility methods which ease execution of cross-database queries and
 * the implementation of concrete Peers.
 *
 * @author     Hans Lellelid <hans@xmpl.org> (Propel)
 * @author     Kaspars Jaudzems <kaspars.jaudzems@inbox.lv> (Propel)
 * @author     Heltem <heltem@o2php.com> (Propel)
 * @author     Frank Y. Kim <frank.kim@clearink.com> (Torque)
 * @author     John D. McNally <jmcnally@collab.net> (Torque)
 * @author     Brett McLaughlin <bmclaugh@algx.net> (Torque)
 * @author     Stephen Haberman <stephenh@chase3000.com> (Torque)
 * @version    $Revision: 847 $
 * @package    propel.util
 */
class BasePeer
{

	/** Array (hash) that contains the cached mapBuilders. */
	private static $mapBuilders = array();

	/** Array (hash) that contains cached validators */
	private static $validatorMap = array();

	/**
	 * phpname type
	 * e.g. 'AuthorId'
	 */
	const TYPE_PHPNAME = 'phpName';

	/**
	 * studlyphpname type
	 * e.g. 'authorId'
	 */
	const TYPE_STUDLYPHPNAME = 'studlyPhpName';

	/**
	 * column (peer) name type
	 * e.g. 'book.AUTHOR_ID'
	 */
	const TYPE_COLNAME = 'colName';

	/**
	 * column fieldname type
	 * e.g. 'author_id'
	 */
	const TYPE_FIELDNAME = 'fieldName';

	/**
	 * num type
	 * simply the numerical array index, e.g. 4
	 */
	const TYPE_NUM = 'num';

	static public function getFieldnames ($classname, $type = self::TYPE_PHPNAME) {

		// TODO we should take care of including the peer class here

		$peerclass = 'Base' . $classname . 'Peer'; // TODO is this always true?
		$callable = array($peerclass, 'getFieldnames');
		$args = array($type);

		return call_user_func_array($callable, $args);
	}

	static public function translateFieldname($classname, $fieldname, $fromType, $toType) {

		// TODO we should take care of including the peer class here

		$peerclass = 'Base' . $classname . 'Peer'; // TODO is this always true?
		$callable = array($peerclass, 'translateFieldname');
		$args = array($fieldname, $fromType, $toType);

		return call_user_func_array($callable, $args);
	}

	/**
	 * Method to perform deletes based on values and keys in a
	 * Criteria.
	 *
	 * @param      Criteria $criteria The criteria to use.
	 * @param      PropelPDO $con A PropelPDO connection object.
	 * @return     int	The number of rows affected by last statement execution.  For most
	 * 				uses there is only one delete statement executed, so this number
	 * 				will correspond to the number of rows affected by the call to this
	 * 				method.  Note that the return value does require that this information
	 * 				is returned (supported) by the PDO driver.
	 * @throws     PropelException
	 */
	public static function doDelete(Criteria $criteria, PropelPDO $con)
	{
		$db = Propel::getDB($criteria->getDbName());
		$dbMap = Propel::getDatabaseMap($criteria->getDbName());

		// Set up a list of required tables (one DELETE statement will
		// be executed per table)

		$tables_keys = array();
		foreach ($criteria as $c) {
			foreach ($c->getAllTables() as $tableName) {
				$tableName2 = $criteria->getTableForAlias($tableName);
				if ($tableName2 !== null) {
					$tables_keys[$tableName2 . ' ' . $tableName] = true;
				} else {
					$tables_keys[$tableName] = true;
				}
			}
		} // foreach criteria->keys()

		$affectedRows = 0; // initialize this in case the next loop has no iterations.

		$tables = array_keys($tables_keys);

		foreach ($tables as $tableName) {

			$whereClause = array();
			$selectParams = array();
			foreach ($dbMap->getTable($tableName)->getColumns() as $colMap) {
				$key = $tableName . '.' . $colMap->getColumnName();
				if ($criteria->containsKey($key)) {
					$sb = "";
					$criteria->getCriterion($key)->appendPsTo($sb, $selectParams);
					$whereClause[] = $sb;
				}
			}

			if (empty($whereClause)) {
				throw new PropelException("Cowardly refusing to delete from table $tableName with empty WHERE clause.");
			}

			// Execute the statement.
			try {
				$sql = "DELETE FROM " . $tableName . " WHERE " .  implode(" AND ", $whereClause);
				$stmt = $con->prepare($sql);
				self::populateStmtValues($stmt, $selectParams, $dbMap, $db);
				$stmt->execute();
				$affectedRows = $stmt->rowCount();
			} catch (Exception $e) {
				Propel::log($e->getMessage(), Propel::LOG_ERR);
				throw new PropelException("Unable to execute DELETE statement.",$e);
			}

		} // for each table

		return $affectedRows;
	}

	/**
	 * Method to deletes all contents of specified table.
	 *
	 * This method is invoked from generated Peer classes like this:
	 * <code>
	 * public static function doDeleteAll($con = null)
	 * {
	 *   if ($con === null) $con = Propel::getConnection(self::DATABASE_NAME);
	 *   BasePeer::doDeleteAll(self::TABLE_NAME, $con);
	 * }
	 * </code>
	 *
	 * @param      string $tableName The name of the table to empty.
	 * @param      PropelPDO $con A PropelPDO connection object.
	 * @return     int	The number of rows affected by the statement.  Note
	 * 				that the return value does require that this information
	 * 				is returned (supported) by the Creole db driver.
	 * @throws     PropelException - wrapping SQLException caught from statement execution.
	 */
	public static function doDeleteAll($tableName, PropelPDO $con)
	{
		try {
			$sql = "DELETE FROM " . $tableName;
			$stmt = $con->prepare($sql);
			$stmt->execute();
			return $stmt->rowCount();
		} catch (Exception $e) {
			Propel::log($e->getMessage(), Propel::LOG_ERR);
			throw new PropelException("Unable to perform DELETE ALL operation.", $e);
		}
	}

	/**
	 * Method to perform inserts based on values and keys in a
	 * Criteria.
	 * <p>
	 * If the primary key is auto incremented the data in Criteria
	 * will be inserted and the auto increment value will be returned.
	 * <p>
	 * If the primary key is included in Criteria then that value will
	 * be used to insert the row.
	 * <p>
	 * If no primary key is included in Criteria then we will try to
	 * figure out the primary key from the database map and insert the
	 * row with the next available id using util.db.IDBroker.
	 * <p>
	 * If no primary key is defined for the table the values will be
	 * inserted as specified in Criteria and null will be returned.
	 *
	 * @param      Criteria $criteria Object containing values to insert.
	 * @param      PropelPDO $con A PropelPDO connection.
	 * @return     mixed The primary key for the new row if (and only if!) the primary key
	 *				is auto-generated.  Otherwise will return <code>null</code>.
	 * @throws     PropelException
	 */
	public static function doInsert(Criteria $criteria, PropelPDO $con) {

		// the primary key
		$id = null;

		$db = Propel::getDB($criteria->getDbName());

		// Get the table name and method for determining the primary
		// key value.
		$keys = $criteria->keys();
		if (!empty($keys)) {
			$tableName = $criteria->getTableName( $keys[0] );
		} else {
			throw new PropelException("Database insert attempted without anything specified to insert");
		}

		$dbMap = Propel::getDatabaseMap($criteria->getDbName());
		$tableMap = $dbMap->getTable($tableName);
		$keyInfo = $tableMap->getPrimaryKeyMethodInfo();
		$useIdGen = $tableMap->isUseIdGenerator();
		//$keyGen = $con->getIdGenerator();

		$pk = self::getPrimaryKey($criteria);

		// only get a new key value if you need to
		// the reason is that a primary key might be defined
		// but you are still going to set its value. for example:
		// a join table where both keys are primary and you are
		// setting both columns with your own values

		// pk will be null if there is no primary key defined for the table
		// we're inserting into.
		if ($pk !== null && $useIdGen && !$criteria->containsKey($pk->getFullyQualifiedName()) && $db->isGetIdBeforeInsert()) {
			try {
				$id = $db->getId($con, $keyInfo);
			} catch (Exception $e) {
				throw new PropelException("Unable to get sequence id.", $e);
			}
			$criteria->add($pk->getFullyQualifiedName(), $id);
		}

		try {
			$adapter = Propel::getDB($criteria->getDBName());

			$qualifiedCols = $criteria->keys(); // we need table.column cols when populating values
			$columns = array(); // but just 'column' cols for the SQL
			foreach ($qualifiedCols as $qualifiedCol) {
				$columns[] = substr($qualifiedCol, strpos($qualifiedCol, '.') + 1);
			}

			// add identifiers
			if ($adapter->useQuoteIdentifier()) {
				$columns = array_map(array($adapter, 'quoteIdentifier'), $columns);
			}

			$sql = "INSERT INTO " . $tableName
				. " (" . implode(",", $columns) . ")"
				. " VALUES (" . substr(str_repeat("?,", count($columns)), 0, -1) . ")";

			$stmt = $con->prepare($sql);
			self::populateStmtValues($stmt, self::buildParams($qualifiedCols, $criteria), $dbMap, $db);
			$stmt->execute();

		} catch (Exception $e) {
			Propel::log($e->getMessage(), Propel::LOG_ERR);
			throw new PropelException("Unable to execute INSERT statement.", $e);
		}

		// If the primary key column is auto-incremented, get the id now.
		if ($pk !== null && $useIdGen && $db->isGetIdAfterInsert()) {
			try {
				$id = $db->getId($con, $keyInfo);
			} catch (Exception $e) {
				throw new PropelException("Unable to get autoincrement id.", $e);
			}
		}

		return $id;
	}

	/**
	 * Method used to update rows in the DB.  Rows are selected based
	 * on selectCriteria and updated using values in updateValues.
	 * <p>
	 * Use this method for performing an update of the kind:
	 * <p>
	 * WHERE some_column = some value AND could_have_another_column =
	 * another value AND so on.
	 *
	 * @param      $selectCriteria A Criteria object containing values used in where
	 *		clause.
	 * @param      $updateValues A Criteria object containing values used in set
	 *		clause.
	 * @param      PropelPDO $con The PropelPDO connection object to use.
	 * @return     int	The number of rows affected by last update statement.  For most
	 * 				uses there is only one update statement executed, so this number
	 * 				will correspond to the number of rows affected by the call to this
	 * 				method.  Note that the return value does require that this information
	 * 				is returned (supported) by the Creole db driver.
	 * @throws     PropelException
	 */
	public static function doUpdate(Criteria $selectCriteria, Criteria $updateValues, PropelPDO $con) {

		$db = Propel::getDB($selectCriteria->getDbName());
		$dbMap = Propel::getDatabaseMap($selectCriteria->getDbName());

		// Get list of required tables, containing all columns
		$tablesColumns = $selectCriteria->getTablesColumns();

		// we also need the columns for the update SQL
		$updateTablesColumns = $updateValues->getTablesColumns();

		$affectedRows = 0; // initialize this in case the next loop has no iterations.

		foreach ($tablesColumns as $tableName => $columns) {

			$whereClause = array();

			$selectParams = array();
			foreach ($columns as $colName) {
				$sb = "";
				$selectCriteria->getCriterion($colName)->appendPsTo($sb, $selectParams);
				$whereClause[] = $sb;
			}

			$stmt = null;
			try {

				$sql = "UPDATE " . $tableName . " SET ";
				foreach ($updateTablesColumns[$tableName] as $col) {
					$updateColumnName = substr($col, strpos($col, '.') + 1);
					// add identifiers for the actual database?
					if ($db->useQuoteIdentifier()) {
						$updateColumnName = $db->quoteIdentifier($updateColumnName);
					}
					if ($updateValues->getComparison($col) != Criteria::CUSTOM_EQUAL)
					{
						$sql .= $updateColumnName . " = ?, ";
					}
					else
					{
						$param = $updateValues->get($col);
						$sql .= $updateColumnName . " = ";
						if(is_array($param))
						{
							if(isset($param['raw']))
							{
								$sql .= $param['raw'] . ", ";
							}
							else
							{
								$sql .= "?, ";
							}
							if(isset($param['value']))
							{
								$updateValues->put($col, $param['value']);
							}
						}
						else
						{
							$updateValues->remove($col);
							$sql .= $param . ", ";
						}
					}
				}

				$sql = substr($sql, 0, -2) . " WHERE " .  implode(" AND ", $whereClause);

				$stmt = $con->prepare($sql);

				// Replace '?' with the actual values
				self::populateStmtValues($stmt, array_merge(self::buildParams($updateTablesColumns[$tableName], $updateValues), $selectParams), $dbMap, $db);

				$stmt->execute();

				$affectedRows = $stmt->rowCount();

				$stmt = null; // close

			} catch (Exception $e) {
				if ($stmt) $stmt = null; // close
				Propel::log($e->getMessage(), Propel::LOG_ERR);
				throw new PropelException("Unable to execute UPDATE statement.", $e);
			}

		} // foreach table in the criteria

		return $affectedRows;
	}

	/**
	 * Executes query build by createSelectSql() and returns ResultSet.
	 *
	 * @param      Criteria $criteria A Criteria.
	 * @param      PropelPDO $con A PropelPDO connection to use.
	 * @return     ResultSet The resultset.
	 * @throws     PropelException
	 * @see        createSelectSql()
	 */
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		$dbMap = Propel::getDatabaseMap($criteria->getDbName());
		$db = Propel::getDB($criteria->getDbName());

		if ($con === null) {
			$con = Propel::getConnection($criteria->getDbName());
		}

		$stmt = null;

		try {

			// Transaction support exists for (only?) Postgres, which must
			// have SELECT statements that include bytea columns wrapped w/
			// transactions.
			if ($criteria->isUseTransaction()) Transaction::begin($con);

			$params = array();
			$sql = self::createSelectSql($criteria, $params);

 			$stmt = $con->prepare($sql);

 			// FIXME - add SQL-modification for LIMIT/OFFSET into DBAdapters & createSelectSql method.
			// $stmt->setLimit($criteria->getLimit());
			// $stmt->setOffset($criteria->getOffset());

			self::populateStmtValues($stmt, $params, $dbMap, $db);

			$stmt->execute();

			if ($criteria->isUseTransaction()) Transaction::commit($con);

		} catch (Exception $e) {
			if ($stmt) $stmt = null; // close
			if ($criteria->isUseTransaction()) Transaction::rollback($con);
			Propel::log($e->getMessage(), Propel::LOG_ERR);
			throw new PropelException($e);
		}

		return $stmt;
	}

	/**
	 * Populates values in a prepared statement.
	 *
	 * @param      PreparedStatement $stmt
	 * @param      array $params array('column' => ..., 'table' => ..., 'value' => ...)
	 * @param      DatabaseMap $dbMap
	 * @return     int The number of params replaced.
	 */
	private static function populateStmtValues($stmt, $params, DatabaseMap $dbMap, DBAdapter $db)
	{
		$i = 1;
		foreach ($params as $param) {
			$tableName = $param['table'];
			$columnName = $param['column'];
			$value = $param['value'];

			if ($value === null) {

				$stmt->bindValue($i++, null, PDO::PARAM_NULL);
				// $stmt->setNull($i++);

			} else {

				$cMap = $dbMap->getTable($tableName)->getColumn($columnName);
				$type = $cMap->getType();
				$pdoType = $cMap->getPdoType();

				// FIXME - This is a temporary hack to get around apparent bugs w/ PDO+MYSQL
				// See http://pecl.php.net/bugs/bug.php?id=9919
				if ($pdoType == PDO::PARAM_BOOL && $db instanceof DBMySQL) {
					$value = (int) $value;
					$pdoType = PDO::PARAM_INT;
				} elseif (is_numeric($value) && $cMap->isEpochTemporal()) { // it's a timestamp that needs to be formatted
					if ($type == PropelColumnTypes::TIMESTAMP) {
						$value = date($db->getTimestampFormatter(), $value);
					} else if ($type == PropelColumnTypes::DATE) {
						$value = date($db->getDateFormatter(), $value);
					} else if ($type == PropelColumnTypes::TIME) {
						$value = date($db->getTimeFormatter(), $value);
					}
				} elseif ($value instanceof DateTime && $cMap->isTemporal()) { // it's a timestamp that needs to be formatted
					if ($type == PropelColumnTypes::TIMESTAMP || $type == PropelColumnTypes::BU_TIMESTAMP) {
						$value = $value->format($db->getTimestampFormatter());
					} else if ($type == PropelColumnTypes::DATE || $type == PropelColumnTypes::BU_DATE) {
						$value = $value->format($db->getDateFormatter());
					} else if ($type == PropelColumnTypes::TIME) {
						$value = $value->format($db->getTimeFormatter());
					}
				} elseif (is_resource($value) && $cMap->isLob()) {
					// we always need to make sure that the stream is rewound, otherwise nothing will
					// get written to database.
					rewind($value);
				}

				if ($type == PropelColumnTypes::BLOB || $type == PropelColumnTypes::CLOB ) {
					Propel::log("Binding [LOB value] at position $i w/ Propel type $type and PDO type $pdoType", Propel::LOG_DEBUG);
				} else {
					Propel::log("Binding " . var_export($value, true) . " at position $i w/ Propel type $type and PDO type $pdoType", Propel::LOG_DEBUG);
				}

				$stmt->bindValue($i++, $value, $pdoType);
			}
		} // foreach
	}

	/**
	 * Applies any validators that were defined in the schema to the specified columns.
	 *
	 * @param      string $dbName The name of the database
	 * @param      string $tableName The name of the table
	 * @param      array $columns Array of column names as key and column values as value.
	 */
	public static function doValidate($dbName, $tableName, $columns)
	{
		$dbMap = Propel::getDatabaseMap($dbName);
		$tableMap = $dbMap->getTable($tableName);
		$failureMap = array(); // map of ValidationFailed objects
		foreach ($columns as $colName => $colValue) {
			if ($tableMap->containsColumn($colName)) {
				$col = $tableMap->getColumn($colName);
				foreach ($col->getValidators() as $validatorMap) {
					$validator = BasePeer::getValidator($validatorMap->getClass());
					if ($validator && ($col->isNotNull() || $colValue !== null) && $validator->isValid($validatorMap, $colValue) === false) {
						if (!isset($failureMap[$colName])) { // for now we do one ValidationFailed per column, not per rule
							$failureMap[$colName] = new ValidationFailed($colName, $validatorMap->getMessage(), $validator);
						}
					}
				}
			}
		}
		return (!empty($failureMap) ? $failureMap : true);
	}

	/**
	 * Helper method which returns the primary key contained
	 * in the given Criteria object.
	 *
	 * @param      Criteria $criteria A Criteria.
	 * @return     ColumnMap If the Criteria object contains a primary
	 *		  key, or null if it doesn't.
	 * @throws     PropelException
	 */
	private static function getPrimaryKey(Criteria $criteria)
	{
		// Assume all the keys are for the same table.
		$keys = $criteria->keys();
		$key = $keys[0];
		$table = $criteria->getTableName($key);

		$pk = null;

		if (!empty($table)) {

			$dbMap = Propel::getDatabaseMap($criteria->getDbName());

			if ($dbMap === null) {
				throw new PropelException("\$dbMap is null");
			}

			if ($dbMap->getTable($table) === null) {
				throw new PropelException("\$dbMap->getTable() is null");
			}

			$columns = $dbMap->getTable($table)->getColumns();
			foreach (array_keys($columns) as $key) {
				if ($columns[$key]->isPrimaryKey()) {
					$pk = $columns[$key];
					break;
				}
			}
		}
		return $pk;
	}

	/**
	 * Method to create an SQL query based on values in a Criteria.
	 *
	 * This method creates only prepared statement SQL (using ? where values
	 * will go).  The second parameter ($params) stores the values that need
	 * to be set before the statement is executed.  The reason we do it this way
	 * is to let the PDO layer handle all escaping & value formatting.
	 *
	 * @param      Criteria $criteria Criteria for the SELECT query.
	 * @param      array &$params Parameters that are to be replaced in prepared statement.
	 * @return     string
	 * @throws     PropelException Trouble creating the query string.
	 */
	public static function createSelectSql(Criteria $criteria, &$params) {

		$db = Propel::getDB($criteria->getDbName());
		$dbMap = Propel::getDatabaseMap($criteria->getDbName());

		// redundant definition $selectModifiers = array();
		$selectClause = array();
		$fromClause = array();
		$joinClause = array();
		$joinTables = array();
		$whereClause = array();
		$orderByClause = array();
		// redundant definition $groupByClause = array();

		$orderBy = $criteria->getOrderByColumns();
		$groupBy = $criteria->getGroupByColumns();
		$ignoreCase = $criteria->isIgnoreCase();
		$select = $criteria->getSelectColumns();
		$aliases = $criteria->getAsColumns();

		// simple copy
		$selectModifiers = $criteria->getSelectModifiers();

		// get selected columns
		foreach ($select as $columnName) {

			// expect every column to be of "table.column" formation
			// it could be a function:  e.g. MAX(books.price)

			$tableName = null;

			$selectClause[] = $columnName; // the full column name: e.g. MAX(books.price)

			$parenPos = strpos($columnName, '(');
			$dotPos = strpos($columnName, '.');

			// [HL] I think we really only want to worry about adding stuff to
			// the fromClause if this function has a TABLE.COLUMN in it at all.
			// e.g. COUNT(*) should not need this treatment -- or there needs to
			// be special treatment for '*'
			if ($dotPos !== false) {

				if ($parenPos === false) { // table.column
					$tableName = substr($columnName, 0, $dotPos);
				} else { // FUNC(table.column)
					$tableName = substr($columnName, $parenPos + 1, $dotPos - ($parenPos + 1));
					// functions may contain qualifiers so only take the last
					// word as the table name.
					// COUNT(DISTINCT books.price)
					$lastSpace = strpos($tableName, ' ');
					if ($lastSpace !== false) { // COUNT(DISTINCT books.price)
						$tableName = substr($tableName, $lastSpace + 1);
					}
				}
				$tableName2 = $criteria->getTableForAlias($tableName);
				if ($tableName2 !== null) {
					$fromClause[] = $tableName2 . ' ' . $tableName;
				} else {
					$fromClause[] = $tableName;
				}

			} // if $dotPost !== null
		}

		// set the aliases
		foreach ($aliases as $alias => $col) {
			$selectClause[] = $col . " AS " . $alias;
		}

		// add the criteria to WHERE clause
		// this will also add the table names to the FROM clause if they are not already
		// invluded via a LEFT JOIN
		foreach ($criteria->keys() as $key) {

			$criterion = $criteria->getCriterion($key);
			$someCriteria = $criterion->getAttachedCriterion();
			$someCriteriaLength = count($someCriteria);
			$table = null;
			for ($i=0; $i < $someCriteriaLength; $i++) {
				$tableName = $someCriteria[$i]->getTable();

				$table = $criteria->getTableForAlias($tableName);
				if ($table !== null) {
					$fromClause[] = $table . ' ' . $tableName;
				} else {
					$fromClause[] = $tableName;
					$table = $tableName;
				}

				$ignoreCase =
					(($criteria->isIgnoreCase()
						|| $someCriteria[$i]->isIgnoreCase())
						&& ($dbMap->getTable($table)->getColumn($someCriteria[$i]->getColumn())->getType() == "string" )
						 );

				$someCriteria[$i]->setIgnoreCase($ignoreCase);
			}

			$criterion->setDB($db);

			$sb = "";
			$criterion->appendPsTo($sb, $params);
			$whereClause[] = $sb;

		}

		// handle RIGHT (straight) joins
		// Loop through the joins,
		// joins with a null join type will be added to the FROM clause and the condition added to the WHERE clause.
		// joins of a specified type: the LEFT side will be added to the fromClause and the RIGHT to the joinClause
		// New Code.
		foreach ((array) $criteria->getJoins() as $join) { // we'll only loop if there's actually something here

			// The join might have been established using an alias name

			$leftTable = $join->getLeftTableName();
			$leftTableAlias = '';
			if ($realTable = $criteria->getTableForAlias($leftTable)) {
				$leftTableAlias = " $leftTable";
				$leftTable = $realTable;
			}

			$rightTable = $join->getRightTableName();
			$rightTableAlias = '';
			if ($realTable = $criteria->getTableForAlias($rightTable)) {
				$rightTableAlias = " $rightTable";
				$rightTable = $realTable;
			}

			// determine if casing is relevant.
			if ($ignoreCase = $criteria->isIgnoreCase()) {
				$leftColType = $dbMap->getTable($leftTable)->getColumn($join->getLeftColumnName())->getType();
				$rightColType = $dbMap->getTable($rightTable)->getColumn($join->getRightColumnName())->getType();
				$ignoreCase = ($leftColType == 'string' || $rightColType == 'string');
			}

			// build the condition
			if ($ignoreCase) {
				$condition = $db->ignoreCase($join->getLeftColumn()) . '=' . $db->ignoreCase($join->getRightColumn());
			} else {
				$condition = $join->getLeftColumn() . '=' . $join->getRightColumn();
			}

			// add 'em to the queues..
			if ($joinType = $join->getJoinType()) {
				if (!$fromClause) {
					$fromClause[] = $leftTable . $leftTableAlias;
				}
				$joinTables[] = $rightTable . $rightTableAlias;
				$joinClause[] = $join->getJoinType() . ' ' . $rightTable . $rightTableAlias . " ON ($condition)";
			} else {
				$fromClause[] = $leftTable . $leftTableAlias;
				$fromClause[] = $rightTable . $rightTableAlias;
				$whereClause[] = $condition;
			}
		}

		// Unique from clause elements
		$fromClause = array_unique($fromClause);

		// tables should not exist in both the from and join clauses
		if ($joinTables && $fromClause) {
			foreach ($fromClause as $fi => $ftable) {
				if (in_array($ftable, $joinTables)) {
					unset($fromClause[$fi]);
				}
			}
		}

		// Add the GROUP BY columns
		$groupByClause = $groupBy;

		$having = $criteria->getHaving();
		$havingString = null;
		if ($having !== null) {
			$sb = "";
			$having->appendPsTo($sb, $params);
			$havingString = $sb;
		}

		 if (!empty($orderBy)) {

			foreach ($orderBy as $orderByColumn) {

				// Add function expression as-is.

				if (strpos($orderByColumn, '(') !== false) {
					$orderByClause[] = $orderByColumn;
					continue;
				}

				// Split orderByColumn (i.e. "table.column DESC")

				$dotPos = strpos($orderByColumn, '.');

				if ($dotPos !== false) {
					$tableName = substr($orderByColumn, 0, $dotPos);
					$columnName = substr($orderByColumn, $dotPos+1);
				}
				else {
					$tableName = '';
					$columnName = $orderByColumn;
				}

				$spacePos = strpos($columnName, ' ');

				if ($spacePos !== false) {
					$direction = substr($columnName, $spacePos);
					$columnName = substr($columnName, 0, $spacePos);
				}
				else {
					$direction = '';
				}

				$tableAlias = $tableName;
				if ($aliasTableName = $criteria->getTableForAlias($tableName)) {
					$tableName = $aliasTableName;
				}

				$columnAlias = $columnName;
				if ($asColumnName = $criteria->getColumnForAs($columnName)) {
					$columnName = $asColumnName;
				}

				$column = $tableName ? $dbMap->getTable($tableName)->getColumn($columnName) : null;

				if ($column && $column->isText()) {
					$orderByClause[] = $db->ignoreCaseInOrderBy("$tableAlias.$columnAlias") . $direction;
					$selectClause[] = $db->ignoreCaseInOrderBy("$tableAlias.$columnAlias");
				}
				else {
					$orderByClause[] = $orderByColumn;
				}
			}
		}

		// from / join tables quoten if it is necessary
		if ($db->useQuoteIdentifier()) {
			$fromClause = array_map(array($db, 'quoteIdentifier'), $fromClause);
			$joinClause = $joinClause ? $joinClause : array_map(array($db, 'quoteIdentifier'), $joinClause);
		}

		// build from-clause
		$from = '';
		if (!empty($joinClause) && count($fromClause) > 1 && ($db instanceof DBMySQL)) {
			$from .= "(" . implode(", ", $fromClause) . ")";
		} else {
			$from .= implode(", ", $fromClause);
		}
		$from .= $joinClause ? ' ' . implode(' ', $joinClause) : '';

		// Build the SQL from the arrays we compiled
		$sql =  "SELECT "
				.($selectModifiers ? implode(" ", $selectModifiers) . " " : "")
				.implode(", ", $selectClause)
				." FROM "  . $from
				.($whereClause ? " WHERE ".implode(" AND ", $whereClause) : "")
				.($groupByClause ? " GROUP BY ".implode(",", $groupByClause) : "")
				.($havingString ? " HAVING ".$havingString : "")
				.($orderByClause ? " ORDER BY ".implode(",", $orderByClause) : "");

		// APPLY OFFSET & LIMIT to the query.
		if ($criteria->getLimit() || $criteria->getOffset()) {
			$db->applyLimit($sql, $criteria->getOffset(), $criteria->getLimit());
		}

		return $sql;

	}

	/**
	 * Builds a params array, like the kind populated by Criterion::appendPsTo().
	 * This is useful for building an array even when it is not using the appendPsTo() method.
	 * @param      array $columns
	 * @param      Criteria $values
	 * @return     array params array('column' => ..., 'table' => ..., 'value' => ...)
	 */
	private static function buildParams($columns, Criteria $values) {
		$params = array();
		foreach ($columns as $key) {
			if ($values->containsKey($key)) {
				$crit = $values->getCriterion($key);
				$params[] = array('column' => $crit->getColumn(), 'table' => $crit->getTable(), 'value' => $crit->getValue());
			}
		}
		return $params;
	}

	/**
	* This function searches for the given validator $name under propel/validator/$name.php,
	* imports and caches it.
	*
	* @param      string $classname The dot-path name of class (e.g. myapp.propel.MyValidator)
	* @return     Validator object or null if not able to instantiate validator class (and error will be logged in this case)
	*/
	public static function getValidator($classname)
	{
		try {
			$v = isset(self::$validatorMap[$classname]) ? self::$validatorMap[$classname] : null;
			if ($v === null) {
				$cls = substr('.'.$classname, strrpos('.'.$classname, '.') + 1);
				$v = new $cls();
				self::$validatorMap[$classname] = $v;
			}
			return $v;
		} catch (Exception $e) {
			Propel::log("BasePeer::getValidator(): failed trying to instantiate " . $classname . ": ".$e->getMessage(), Propel::LOG_ERR);
		}
	}

}