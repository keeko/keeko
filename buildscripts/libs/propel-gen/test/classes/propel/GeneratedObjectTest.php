<?php
/*
 *  $Id: GeneratedObjectTest.php 842 2007-12-02 16:28:20Z heltem $
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

require_once 'bookstore/BookstoreTestBase.php';

/**
 * Tests the generated Object classes.
 *
 * This test uses generated Bookstore classes to test the behavior of various
 * object operations.  The _idea_ here is to test every possible generated method
 * from Object.tpl; if necessary, bookstore will be expanded to accommodate this.
 *
 * The database is relaoded before every test and flushed after every test.  This
 * means that you can always rely on the contents of the databases being the same
 * for each test method in this class.  See the BookstoreDataPopulator::populate()
 * method for the exact contents of the database.
 *
 * @see        BookstoreDataPopulator
 * @author     Hans Lellelid <hans@xmpl.org>
 */
class GeneratedObjectTest extends BookstoreTestBase {

	/**
	 * Test saving an object after setting default values for it.
	 */
	public function testSaveWithDefaultValues()
	{
		// From the schema.xml, I am relying on the following:
		//  - that 'Penguin' is the default Name for a Publisher
		//  - that 2001-01-01 is the default ReviewDate for a Review

		// 1) check regular values (VARCHAR)
		$pub = new Publisher();
		$pub->setName('Penguin');
		$pub->save();
		$this->assertTrue($pub->getId() !== null, "Expect Publisher to have been saved when default value set.");

		// 2) check date/time values
		$review = new Review();
		// note that this is different from how it's represented in schema, but should resolve to same unix timestamp
		$review->setReviewDate('2001-01-01');
		$this->assertTrue($review->isModified(), "Expect Review to have been marked 'modified' after default date/time value set.");

	}

	/**
	 * Test default return values.
	 */
	public function testDefaultValues()
	{
		$r = new Review();
		$this->assertEquals('2001-01-01', $r->getReviewDate('Y-m-d'));

		$this->assertFalse($r->isModified(), "expected isModified() to be falseb");

		$acct = new BookstoreEmployeeAccount();
		$this->assertEquals(true, $acct->getEnabled());
		$this->assertFalse($acct->isModified());

		$acct->setLogin("testuser");
		$acct->setPassword("testpass");
		$this->assertTrue($acct->isModified());
	}

	/**
	 * Tests the use of default expressions.
	 * (Also indirectly tests the reload() method.)
	 */
	public function testDefaultExpresions()
	{
		if (Propel::getDb(BookstoreEmployeePeer::DATABASE_NAME) instanceof DBSqlite) {
			$this->markTestSkipped("Cannot test default expressions with SQLite");
		}

		$employee = new BookstoreEmployee();
		$employee->setName("Johnny Walker");

		$acct = new BookstoreEmployeeAccount();
		$acct->setBookstoreEmployee($employee);
		$acct->setLogin("test-login");

		$this->assertNull($acct->getCreated());

		$acct->save();

		// BookstoreEmployeeAccountPeer::removeInstanceFromPool($acct);

		$acct = BookstoreEmployeeAccountPeer::retrieveByPK($acct->getEmployeeId());
		$this->assertNotNull($acct->getCreated(), "Expected a valid date after retrieving saved object.");

		$now = new DateTime("now");
		$this->assertEquals($now->format("Y-m-d"), $acct->getCreated("Y-m-d"));

		$acct->setCreated($now);
		$this->assertEquals($now->format("Y-m-d"), $acct->getCreated("Y-m-d"));

	}

	/**
	 * Test the behavior of date/time/values.
	 * This requires that the model was built with propel.useDateTimeClass=true.
	 */
	public function testTemporalValues_PreEpoch()
	{
		$r = new Review();

		$preEpochDate = new DateTime('1602-02-02');

		$r->setReviewDate($preEpochDate);

		$this->assertEquals('1602-02-02', $r->getReviewDate(null)->format("Y-m-d"));

		$r->setReviewDate('1702-02-02');

		$this->assertTrue($r->isModified());

		$this->assertEquals('1702-02-02', $r->getReviewDate(null)->format("Y-m-d"));

		// Now test for setting null
		$r->setReviewDate(null);
		$this->assertNull($r->getReviewDate());

	}

	/**
	 * Test setting invalid date/time.
	 */
	public function _disabled_testSetTemporalValue_Invalid()
	{
		// FIXME - Figure out why this doesn't work (doesn't throw Exception) in the Phing+PHPUnit context
		$r = new Review();
		try {
			$r->setReviewDate("Invalid Date");
			$this->fail("Expected PropelException when setting date column w/ invalid date");
		} catch (PropelException $x) {
			print "Caught expected PropelException: " . $x->__toString();
		}
	}

	/**
	 * Test setting TIMESTAMP columns w/ unix int timestamp.
	 */
	public function testTemporalValues_Unix()
	{
		$store = new Bookstore();
		$store->setStoreName("test");
		$store->setStoreOpenTime(strtotime('12:55'));
		$store->save();
		$this->assertEquals('12:55', $store->getStoreOpenTime(null)->format('H:i'));
	}

	/**
	 * Test setting TIME columns.
	 */
	public function testTemporalValues_TimeSetting()
	{
		$store = new Bookstore();
		$store->setStoreName("test");
		$store->setStoreOpenTime("12:55");
		$store->save();

		$store = new Bookstore();
		$store->setStoreName("test2");
		$store->setStoreOpenTime(new DateTime("12:55"));
		$store->save();
	}

	/**
	 * Test setting TIME columns.
	 */
	public function testTemporalValues_DateSetting()
	{
		$r = new Review();
		$r->setBook(BookPeer::doSelectOne(new Criteria()));
		$r->setReviewDate(new DateTime('1999-12-20'));
		$r->setReviewedBy("Hans");
		$r->setRecommended(false);
		$r->save();
	}

	/**
	 * Testing creating & saving new object & instance pool.
	 */
	public function testObjectInstances_New()
	{
		$emp = new BookstoreEmployee();
		$emp->setName(md5(microtime()));
		$emp->save();
		$id = $emp->getId();

		$retrieved = BookstoreEmployeePeer::retrieveByPK($id);
		$this->assertSame($emp, $retrieved, "Expected same object (from instance pool)");
	}

	/**
	 *
	 */
	public function testObjectInstances_Fkeys()
	{
		// Establish a relationship between one employee and account
		// and then change the employee_id and ensure that the account
		// is not pulling the old employee.

		$pub1 = new Publisher();
		$pub1->setName('Publisher 1');
		$pub1->save();

		$pub2 = new Publisher();
		$pub2->setName('Publisher 2');
		$pub2->save();

		$book = new Book();
		$book->setTitle("Book Title");
		$book->setISBN("1234");
		$book->setPublisher($pub1);
		$book->save();

		$this->assertSame($pub1, $book->getPublisher());

		// now change values behind the scenes
		$con = Propel::getConnection(BookstoreEmployeeAccountPeer::DATABASE_NAME);
		$con->exec("UPDATE " . BookPeer::TABLE_NAME . " SET "
		. " publisher_id = " . $pub2->getId()
		. " WHERE id = " . $book->getId());


		$book2 = BookPeer::retrieveByPK($book->getId());
		$this->assertSame($book, $book2, "Expected same book object instance");

		$this->assertEquals($pub2->getId(), $book->getPublisherId(), "Expected book to have new publisher id");
		$this->assertSame($pub2, $book->getPublisher(), "Expected book to have new publisher object associated.");

		// Now let's set it back and also verify that reload() works ...

		$con->exec("UPDATE " . BookPeer::TABLE_NAME . " SET "
		. " publisher_id = " . $pub1->getId()
		. " WHERE id = " . $book->getId());

		$book->reload();

		$this->assertEquals($pub1->getId(), $book->getPublisherId(), "Expected book to have old publisher id (again).");
		$this->assertSame($pub1, $book->getPublisher(), "Expected book to have old publisher object associated (again).");

	}

	/**
	 * Test the reload() method.
	 */
	public function testReload()
	{
		$a = AuthorPeer::doSelectOne(new Criteria());

		$origName = $a->getFirstName();

		$a->setFirstName(md5(time()));

		$this->assertNotEquals($origName, $a->getFirstName());
		$this->assertTrue($a->isModified());

		$a->reload();

		$this->assertEquals($origName, $a->getFirstName());
		$this->assertFalse($a->isModified());

	}

	/**
	 * Test reload(deep=true) method.
	 */
	public function testReloadDeep()
	{
		// arbitrary book
		$b = BookPeer::doSelectOne(new Criteria());

		// arbitrary, different author
		$c = new Criteria();
		$c->add(AuthorPeer::ID, $b->getAuthorId(), Criteria::NOT_EQUAL);
		$a = AuthorPeer::doSelectOne($c);

		$origAuthor = $b->getAuthor();

		$b->setAuthor($a);

		$this->assertNotEquals($origAuthor, $b->getAuthor(), "Expected just-set object to be different from obj from DB");
		$this->assertTrue($b->isModified());

		$b->reload($deep=true);

		$this->assertEquals($origAuthor, $b->getAuthor(), "Expected object in DB to be restored");
		$this->assertFalse($a->isModified());
	}

	/**
	 * Test saving an object and getting correct number of affected rows from save().
	 * This includes tests of cascading saves to fk-related objects.
	 */
	public function testSaveReturnValues()
	{

		$author = new Author();
		$author->setFirstName("Mark");
		$author->setLastName("Kurlansky");
		// do not save

		$pub = new Publisher();
		$pub->setName("Penguin Books");
		// do not save

		$book = new Book();
		$book->setTitle("Salt: A World History");
		$book->setISBN("0142001619");
		$book->setAuthor($author);
		$book->setPublisher($pub);

		$affected = $book->save();
		$this->assertEquals(3, $affected, "Expected 3 affected rows when saving book + publisher + author.");

		// change nothing ...
		$affected = $book->save();
		$this->assertEquals(0, $affected, "Expected 0 affected rows when saving already-saved book.");

		// modify the book (UPDATE)
		$book->setTitle("Salt A World History");
		$affected = $book->save();
		$this->assertEquals(1, $affected, "Expected 1 affected row when saving modified book.");

		// modify the related author
		$author->setLastName("Kurlanski");
		$affected = $book->save();
		$this->assertEquals(1, $affected, "Expected 1 affected row when saving book with updated author.");

		// modify both the related author and the book
		$author->setLastName("Kurlansky");
		$book->setTitle("Salt: A World History");
		$affected = $book->save();
		$this->assertEquals(2, $affected, "Expected 2 affected rows when saving updated book with updated author.");

	}

	/**
	 * Test deleting an object using the delete() method.
	 */
	public function testDelete() {

		// 1) grab an arbitrary object
		$book = BookPeer::doSelectOne(new Criteria());
		$bookId = $book->getId();

		// 2) delete it
		$book->delete();

		// 3) make sure it can't be save()d now that it's deleted
		try {
			$book->setTitle("Will Fail");
			$book->save();
			$this->fail("Expect an exception to be thrown when attempting to save() a deleted object.");
		} catch (PropelException $e) {}

		// 4) make sure that it doesn't exist in db
		$book = BookPeer::retrieveByPK($bookId);
		$this->assertNull($book, "Expect NULL from retrieveByPK on deleted Book.");

	}

	/**
	 *
	 */
	public function testNoColsModified()
	{
		$e1 = new BookstoreEmployee();
		$e1->setName('Employee 1');

		$e2 = new BookstoreEmployee();
		$e2->setName('Employee 2');

		$super = new BookstoreEmployee();
		// we don't know who the supervisor is yet
		$super->addSubordinate($e1);
		$super->addSubordinate($e2);

		$affected = $super->save();

	}

	/**
	 * Tests new one-to-one functionality.
	 *
	 * @todo       -cGeneratedObjectTest Add a test for one-to-one when implemented.
	 */
	public function testOneToOne()
	{
		$emp = BookstoreEmployeePeer::doSelectOne(new Criteria());

		$acct = new BookstoreEmployeeAccount();
		$acct->setBookstoreEmployee($emp);
		$acct->setLogin("testuser");
		$acct->setPassword("testpass");

		$this->assertSame($emp->getBookstoreEmployeeAccount(), $acct, "Expected same object instance.");
	}

	/**
	 * Test the type sensitivity of the resturning columns.
	 *
	 */
	public function testTypeSensitive()
	{
		$book = BookPeer::doSelectOne(new Criteria());

		$r = new Review();
		$r->setReviewedBy("testTypeSensitive Tester");
		$r->setReviewDate(time());
		$r->setBook($book);
		$r->setRecommended(true);
		$r->save();

		$id = $r->getId();
		unset($r);

		// clear the instance cache to force reload from database.
		ReviewPeer::clearInstancePool();
		BookPeer::clearInstancePool();

		// reload and verify that the types are the same
		$r2 = ReviewPeer::retrieveByPK($id);

		$this->assertType('integer', $r2->getId(), "Expected getId() to return an integer.");
		$this->assertType('string', $r2->getReviewedBy(), "Expected getReviewedBy() to return a string.");
		$this->assertType('boolean', $r2->getRecommended(), "Expected getRecommended() to return a boolean.");
		$this->assertType('Book', $r2->getBook(), "Expected getBook() to return a Book.");
		$this->assertType('float', $r2->getBook()->getPrice(), "Expected Book->getPrice() to return a float.");
		$this->assertType('DateTime', $r2->getReviewDate(null), "Expected Book->getReviewDate() to return a DateTime.");

	}

	/**
	 * This is a test for expected exceptions when saving UNIQUE.
	 * See http://propel.phpdb.org/trac/ticket/2
	 */
	public function testSaveUnique()
	{
		$emp = new BookstoreEmployee();
		$emp->setName(md5(microtime()));

		$acct = new BookstoreEmployeeAccount();
		$acct->setBookstoreEmployee($emp);
		$acct->setLogin("foo");
		$acct->setPassword("bar");
		$acct->save();

		// now attempt to create a new acct
		$acct2 = $acct->copy();

		try {
			$acct2->save();
			$this->fail("Expected PropelException in first attempt to save object with duplicate value for UNIQUE constraint.");
		} catch (Exception $x) {
			try {
				// attempt to save it again
				$acct3 = $acct->copy();
				$acct3->save();
				$this->fail("Expected PropelException in second attempt to save object with duplicate value for UNIQUE constraint.");
			} catch (Exception $x) {
				// this is expected.
			}
			// now let's double check that it can succeed if we're not violating the constraint.
			$acct3->setLogin("foo2");
			$acct3->save();
		}
	}

	/**
	 * Test for correct reporting of isModified().
	 */
	public function testIsModified()
	{
		// 1) Basic test

		$a = new Author();
		$a->setFirstName("John");
		$a->setLastName("Doe");
		$a->setAge(25);

		$this->assertTrue($a->isModified(), "Expected Author to be modified after setting values.");

		$a->save();

		$this->assertFalse($a->isModified(), "Expected Author to be unmodified after saving set values.");

		// 2) Test behavior with setting vars of different types

		// checking setting int col to string val
		$a->setAge('25');
		$this->assertFalse($a->isModified(), "Expected Author to be unmodified after setting int column to string-cast of same value.");

		$a->setFirstName("John2");
		$this->assertTrue($a->isModified(), "Expected Author to be modified after changing string column value.");

		// checking setting string col to int val
		$a->setFirstName("1");
		$a->save();
		$this->assertFalse($a->isModified(), "Expected Author to be unmodified after saving set values.");

		$a->setFirstName(1);
		$this->assertFalse($a->isModified(), "Expected Author to be unmodified after setting string column to int-cast of same value.");

		// 3) Test for appropriate behavior of NULL

		// checking "" -> NULL
		$a->setFirstName("");
		$a->save();
		$this->assertFalse($a->isModified(), "Expected Author to be unmodified after saving set values.");

		$a->setFirstName(null);
		$this->assertTrue($a->isModified(), "Expected Author to be modified after changing empty string column value to NULL.");

		$a->setFirstName("John");
		$a->setAge(0);
		$a->save();
		$this->assertFalse($a->isModified(), "Expected Author to be unmodified after saving set values.");

		$a->setAge(null);
		$this->assertTrue($a->isModified(), "Expected Author to be modified after changing 0-value int column to NULL.");

		$a->save();
		$this->assertFalse($a->isModified(), "Expected Author to be unmodified after saving set values.");

		$a->setAge(0);
		$this->assertTrue($a->isModified(), "Expected Author to be modified after changing NULL-value int column to 0.");

	}

	/**
	 * Test the BaseObject#equals().
	 */
	public function testEquals()
	{
		$b = BookPeer::doSelectOne(new Criteria());
		$c = new Book();
		$c->setId($b->getId());
		$this->assertTrue($b->equals($c), "Expected Book objects to be equal()");

		$a = new Author();
		$a->setId($b->getId());
		$this->assertFalse($b->equals($a), "Expected Book and Author with same primary key NOT to match.");
	}

	/**
	 * Test checking for non-default values.
	 * @see        http://propel.phpdb.org/trac/ticket/331
	 */
	public function testHasOnlyDefaultValues()
	{
		$emp = new BookstoreEmployee();
		$emp->setName(md5(microtime()));

		$acct2 = new BookstoreEmployeeAccount();

		$acct = new BookstoreEmployeeAccount();
		$acct->setBookstoreEmployee($emp);
		$acct->setLogin("foo");
		$acct->setPassword("bar");
		$acct->save();

		$this->assertFalse($acct->isModified(), "Expected BookstoreEmployeeAccount NOT to be modified after save().");

		$acct->setEnabled(true);
		$acct->setPassword($acct2->getPassword());

		$this->assertTrue($acct->isModified(), "Expected BookstoreEmployeeAccount to be modified after setting default values.");

		$this->assertTrue($acct->hasOnlyDefaultValues(), "Expected BookstoreEmployeeAccount to not have only default values.");

		$acct->setPassword("bar");
		$this->assertFalse($acct->hasOnlyDefaultValues(), "Expected BookstoreEmployeeAccount to have at one non-default value after setting one value to non-default.");

		// Test a default date/time value
		$r = new Review();
		$r->setReviewDate(new DateTime("now"));
		$this->assertFalse($r->hasOnlyDefaultValues());
	}

	/**
	 * Test the LOB results returned in a resultset.
	 */
	public function testLobResults()
	{

		$blob_path = TESTS_BASE_DIR . '/etc/lob/tin_drum.gif';
		$clob_path = TESTS_BASE_DIR . '/etc/lob/tin_drum.txt';

		$book = BookPeer::doSelectOne(new Criteria());

		$m1 = new Media();
		$m1->setBook($book);
		$m1->setCoverImage(file_get_contents($blob_path));
		$m1->setExcerpt(file_get_contents($clob_path));
		$m1->save();
		$m1_id = $m1->getId();

		$m1->reload();

		$img = $m1->getCoverImage();
		$txt = $m1->getExcerpt();

		$this->assertType('resource', $img, "Expected results of BLOB method to be a resource.");
		$this->assertType('string', $txt, "Expected results of CLOB method to be a string.");

		$stat = fstat($img);
		$size = $stat['size'];

		$this->assertEquals(filesize($blob_path), $size, "Expected filesize to match stat(blobrsc)");
		$this->assertEquals(filesize($clob_path), strlen($txt), "Expected filesize to match clob strlen");
	}

	/**
	 * Tests the setting of LOB (BLOB and CLOB) values.
	 */
	public function testLobSetting()
	{
		$blob_path = TESTS_BASE_DIR . '/etc/lob/tin_drum.gif';
		$blob2_path = TESTS_BASE_DIR . '/etc/lob/propel.gif';

		$clob_path = TESTS_BASE_DIR . '/etc/lob/tin_drum.txt';
		$book = BookPeer::doSelectOne(new Criteria());

		$m1 = new Media();
		$m1->setBook($book);
		$m1->setCoverImage(file_get_contents($blob_path));
		$m1->setExcerpt(file_get_contents($clob_path));
		$m1->save();
		$m1_id = $m1->getId();

		// 1) Assert that we've got a valid stream to start with
		$img = $m1->getCoverImage();
		$this->assertType('resource', $img, "Expected results of BLOB method to be a resource.");

		// 2) Test setting a BLOB column with file contents
		$m1->setCoverImage(file_get_contents($blob2_path));
		$this->assertType('resource', $m1->getCoverImage(), "Expected to get a resource back after setting BLOB with file contents.");

		// commit those changes & reload
		$m1->save();

		// 3) Verify that we've got a valid resource after reload
		$m1->reload();
		$this->assertType('resource', $m1->getCoverImage(), "Expected to get a resource back after setting reloading object.");

		// 4) Test isModified() behavior
		$fp = fopen("php://temp", "r+");
		fwrite($fp, file_get_contents($blob2_path));

		$m1->setCoverImage($fp);
		$this->assertTrue($m1->isModified(), "Expected Media object to be modified, despite fact that stream is to same data");

		// 5) Test external modification of the stream (and re-setting it into the object)
		$stream = $m1->getCoverImage();
		fwrite($stream, file_get_contents($blob_path)); // change the contents of the stream

		$m1->setCoverImage($stream);

		$this->assertTrue($m1->isModified(), "Expected Media object to be modified when stream contents changed.");
		$this->assertNotEquals(file_get_contents($blob2_path), stream_get_contents($m1->getCoverImage()));

		$m1->save();

		// 6) Assert that when we call the setter with a stream, that the file in db gets updated.

		$m1->reload(); // start with a fresh copy from db

		// Ensure that object is set up correctly
		$this->assertNotEquals(file_get_contents($blob_path), stream_get_contents($m1->getCoverImage()), "The object is not correctly set up to verify the stream-setting test.");

		$fp = fopen($blob_path, "r");
		$m1->setCoverImage($fp);
		$m1->save();
		$m1->reload(); // refresh from db

		// Assert that we've updated the db
		$this->assertEquals(file_get_contents($blob_path), stream_get_contents($m1->getCoverImage()), "Expected the updated BLOB value after setting with a stream.");

		// 7) Assert that 'w' mode works

	}

	public function testLobSetting_WriteMode()
	{
		$blob_path = TESTS_BASE_DIR . '/etc/lob/tin_drum.gif';
		$blob2_path = TESTS_BASE_DIR . '/etc/lob/propel.gif';

		$clob_path = TESTS_BASE_DIR . '/etc/lob/tin_drum.txt';
		$book = BookPeer::doSelectOne(new Criteria());

		$m1 = new Media();
		$m1->setBook($book);
		$m1->setCoverImage(file_get_contents($blob_path));
		$m1->setExcerpt(file_get_contents($clob_path));
		$m1->save();

		MediaPeer::clearInstancePool();

		// make sure we have the latest from the db:
		$m2 = MediaPeer::retrieveByPK($m1->getId());

		// now attempt to assign a temporary stream, opened in 'w' mode, to the db

		$stream = fopen("php://memory", 'w');
		fwrite($stream, file_get_contents($blob2_path));
		$m2->setCoverImage($stream);
		$m2->save();
		fclose($stream);

		$m2->reload();
		$this->assertEquals(file_get_contents($blob2_path), stream_get_contents($m2->getCoverImage()), "Expected contents to match when setting stream w/ 'w' mode");

		$stream2 = fopen("php://memory", 'w+');
		fwrite($stream2, file_get_contents($blob_path));
		rewind($stream2);
		$this->assertEquals(file_get_contents($blob_path), stream_get_contents($stream2), "Expecting setup to be correct");

		$m2->setCoverImage($stream2);
		$m2->save();
		$m2->reload();

		$this->assertEquals(file_get_contents($blob_path), stream_get_contents($m2->getCoverImage()), "Expected contents to match when setting stream w/ 'w+' mode");

	}


	public function testDefaultFkColVal()
	{
		$sale = new BookstoreSale();
		$this->assertEquals(1, $sale->getBookstoreId(), "Expected BookstoreSale object to have a default ID.");

		$bookstore = BookstorePeer::doSelectOne(new Criteria());

		$sale->setBookstore($bookstore);
		$this->assertEquals($bookstore->getId(), $sale->getBookstoreId(), "Expected FK id to have changed when assigned a valid FK.");

		$sale->setBookstore(null);
		$this->assertEquals(1, $sale->getBookstoreId(), "Expected BookstoreSale object to have reset to default ID.");

		$sale->setPublisher(null);
		$this->assertEquals(null, $sale->getPublisherId(), "Expected BookstoreSale object to have reset to NULL publisher ID.");
	}

	public function testCountRefFk()
	{
		$book = new Book();
		$book->setTitle("Test Book");
		$book->setISBN("TT-EE-SS-TT");

		$num = 5;

		for ($i=2; $i < $num + 2; $i++) {
			$r = new Review();
			$r->setReviewedBy('Hans ' . $num);
			$dt = new DateTime("now");
			$dt->modify("-".$i." weeks");
			$r->setReviewDate($dt);
			$r->setRecommended(($i % 2) == 0);
			$book->addReview($r);
		}

		$this->assertEquals($num, $book->countReviews(), "Expected countReviews to return $num");
		$this->assertEquals($num, count($book->getReviews()), "Expected getReviews to return $num reviews");

		$book->save();

		BookPeer::clearInstancePool();
		ReviewPeer::clearInstancePool();

		$book = BookPeer::retrieveByPK($book->getId());
		$this->assertEquals($num, $book->countReviews(), "Expected countReviews() to return $num (after save)");
		$this->assertEquals($num, count($book->getReviews()), "Expected getReviews() to return $num (after save)");

		// Now set different criteria and expect different results
		$c = new Criteria();
		$c->add(ReviewPeer::RECOMMENDED, false);
		$this->assertEquals(floor($num/2), $book->countReviews($c), "Expected " . floor($num/2) . " results from countReviews(recomm=false)");

		// Change Criteria, run again -- expect different.
		$c = new Criteria();
		$c->add(ReviewPeer::RECOMMENDED, true);
		$this->assertEquals(ceil($num/2), count($book->getReviews($c)), "Expected " . ceil($num/2) . " results from getReviews(recomm=true)");

		$this->assertEquals($num, $book->countReviews(), "Expected countReviews to return $num with new empty Criteria");
	}

	/**
	 * Test copyInto method.
	 */
	public function testCopyInto_Deep()
	{
		// Test a "normal" object
		$c = new Criteria();
		$c->add(BookPeer::TITLE, 'Harry%', Criteria::LIKE);

		$book = BookPeer::doSelectOne($c);
		$reviews = $book->getReviews();

		$b2 = $book->copy(true);
		$this->assertType('Book', $b2);
		$this->assertNull($b2->getId());

		$r2 = $b2->getReviews();

		$this->assertEquals(count($reviews), count($r2));

		// Test a one-to-one object
		$emp = BookstoreEmployeePeer::doSelectOne(new Criteria());
		$e2 = $emp->copy(true);

		$this->assertType('BookstoreEmployee', $e2);
		$this->assertNull($e2->getId());

		$this->assertEquals($emp->getBookstoreEmployeeAccount()->getLogin(), $e2->getBookstoreEmployeeAccount()->getLogin());
	}

	/**
	 * Test the toArray() method with new lazyLoad param.
	 * @link       http://propel.phpdb.org/trac/ticket/527
	 */
	public function testToArrayLazyLoad()
	{
		$c = new Criteria();
		$c->add(MediaPeer::COVER_IMAGE, null, Criteria::NOT_EQUAL);
		$c->add(MediaPeer::EXCERPT, null, Criteria::NOT_EQUAL);

		$m = MediaPeer::doSelectOne($c);
		if ($m === null) {
			$this->fail("Test requires at least one media row w/ cover_image and excerpt NOT NULL");
		}

		$arr1 = $m->toArray(BasePeer::TYPE_COLNAME);
		$this->assertNotNull($arr1[MediaPeer::COVER_IMAGE]);
		$this->assertType('resource', $arr1[MediaPeer::COVER_IMAGE]);

		$arr2 = $m->toArray(BasePeer::TYPE_COLNAME, false);
		$this->assertNull($arr2[MediaPeer::COVER_IMAGE]);
		$this->assertNull($arr2[MediaPeer::EXCERPT]);

		$diffKeys = array_keys(array_diff($arr1, $arr2));

		$expectedDiff = array(MediaPeer::COVER_IMAGE, MediaPeer::EXCERPT);

		$this->assertEquals($expectedDiff, $diffKeys);
	}
}