<?php

/*
 *  $Id: DBSybase.php 784 2007-11-08 10:15:50Z heltem $
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
 * This is used to connect to a Sybase database.
 *
 * <B>NOTE:</B><I>Currently JConnect does not implement the required
 * methods for ResultSetMetaData, and therefore the village API's may
 * not function.  For connection pooling, everything works.</I>
 *
 * @author     Hans Lellelid <hans@xmpl.org> (Propel)
 * @author     Jeff Brekke <ekkerbj@netscape.net> (Torque)
 * @version    $Revision: 784 $
 * @package    propel.adapter
 */
class DBSybase extends DBAdapter {

	/**
	 * This method is used to ignore case.
	 *
	 * @param      in The string to transform to upper case.
	 * @return     The upper case string.
	 */
	public function toUpperCase($in)
	{
		return "UPPER(" . $in . ")";
	}

	/**
	 * This method is used to ignore case.
	 *
	 * @param      in The string whose case to ignore.
	 * @return     The string in a case that can be ignored.
	 */
	public function ignoreCase($in)
	{
		return "UPPER(" . $in . ")";
	}

	/**
	 * Returns SQL which concatenates the second string to the first.
	 *
	 * @param      string String to concatenate.
	 * @param      string String to append.
	 * @return     string
	 */
	public function concatString($s1, $s2)
	{
		return "($s1 + $s2)";
	}

	/**
	 * Returns SQL which extracts a substring.
	 *
	 * @param      string String to extract from.
	 * @param      int Offset to start from.
	 * @param      int Number of characters to extract.
	 * @return     string
	 */
	public function subString($s, $pos, $len)
	{
		return "SUBSTRING($s, $pos, $len)";
	}

	/**
	 * Returns SQL which calculates the length (in chars) of a string.
	 *
	 * @param      string String to calculate length of.
	 * @return     string
	 */
	public function strLength($s)
	{
		return "LEN($s)";
	}

	/**
	 * @see        DBAdapter::quoteIdentifier()
	 */
	public function quoteIdentifier($text)
	{
		return '[' . $text . ']';
	}

	/**
	 * @see        DBAdapter::random()
	 */
	public function random($seed = null)
	{
		return 'rand('.((int) $seed).')';
	}
}
