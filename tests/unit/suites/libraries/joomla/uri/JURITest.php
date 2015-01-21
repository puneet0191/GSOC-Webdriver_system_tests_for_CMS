<?php
/**
 * @package     Joomla.UnitTest
 * @subpackage  Uri
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

/**
 * Test class for JUri.
 * Generated by PHPUnit on 2009-10-09 at 14:03:19.
 *
 * @package     Joomla.UnitTest
 * @subpackage  Uri
 * @since       11.1
 */
class JUriTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @var    JUri
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 *
	 * @return  void
	 *
	 * @since   11.1
	 */
	protected function setUp()
	{
		parent::setUp();

		JUri::reset();

		$_SERVER['HTTP_HOST'] = 'www.example.com:80';
		$_SERVER['SCRIPT_NAME'] = '/joomla/index.php';
		$_SERVER['PHP_SELF'] = '/joomla/index.php';
		$_SERVER['REQUEST_URI'] = '/joomla/index.php?var=value 10';

		$this->object = new JUri;
	}

	/**
	 * Test the __toString method.
	 *
	 * @return  void
	 *
	 * @since   11.1
	 * @covers  JUri::__toString
	 */
	public function test__toString()
	{
		$this->object->parse('http://someuser:somepass@www.example.com:80/path/file.html?var=value#fragment');

		$this->assertThat(
			$this->object->__toString(),
			$this->equalTo('http://someuser:somepass@www.example.com:80/path/file.html?var=value#fragment')
		);
	}

	/**
	 * Test the getInstance method.
	 *
	 * @return  void
	 *
	 * @since   11.1
	 * @covers  JUri::getInstance
	 */
	public function testGetInstance()
	{
		$return = JUri::getInstance('http://someuser:somepass@www.example.com:80/path/file.html?var=value#fragment');
		$this->object->parse('http://someuser:somepass@www.example.com:80/path/file.html?var=value#fragment');

		$this->assertThat(
			$return,
			$this->equalTo($this->object)
		);

		$this->object->parse('http://www.example.com:80/joomla/index.php?var=value 10');
		$_SERVER['HTTP_HOST'] = 'www.example.com:80';
		$_SERVER['SCRIPT_NAME'] = '/joomla/index.php';
		$_SERVER['PHP_SELF'] = '/joomla/index.php';
		$_SERVER['REQUEST_URI'] = '/joomla/index.php?var=value 10';

		$return = JUri::getInstance();
		$this->assertThat(
			$return,
			$this->equalTo($this->object)
		);
	}

	/**
	 * Test the root method.
	 *
	 * @return  void
	 *
	 * @since   11.1
	 * @covers  JUri::root
	 */
	public function testRoot()
	{
		$this->assertThat(
			JUri::root(false, '/administrator'),
			$this->equalTo('http://www.example.com:80/administrator/')
		);
	}

	/**
	 * Test the current method.
	 *
	 * @return  void
	 *
	 * @since   11.1
	 * @covers  JUri::current
	 */
	public function testCurrent()
	{
		$this->assertThat(
			JUri::current(),
			$this->equalTo('http://www.example.com:80/joomla/index.php')
		);
	}

	/**
	 * Test the parse method.
	 *
	 * @return  void
	 *
	 * @since   11.1
	 * @covers  JUri::parse
	 */
	public function testParse()
	{
		$this->object->parse('http://someuser:somepass@www.example.com:80/path/file.html?var=value&amp;test=true#fragment');

		$this->assertThat(
			$this->object->getHost(),
			$this->equalTo('www.example.com')
		);

		$this->assertThat(
			$this->object->getPath(),
			$this->equalTo('/path/file.html')
		);

		$this->assertThat(
			$this->object->getScheme(),
			$this->equalTo('http')
		);
	}

	/**
	 * Test the toString method.
	 *
	 * @return  void
	 *
	 * @since   11.1
	 * @covers  JUri::toString
	 */
	public function testToString()
	{
		$this->object->parse('http://someuser:somepass@www.example.com:80/path/file.html?var=value#fragment');

		$this->assertThat(
			$this->object->toString(),
			$this->equalTo('http://someuser:somepass@www.example.com:80/path/file.html?var=value#fragment')
		);

		$this->object->setQuery('somevar=somevalue');
		$this->object->setVar('somevar2', 'somevalue2');
		$this->object->setScheme('ftp');
		$this->object->setUser('root');
		$this->object->setPass('secret');
		$this->object->setHost('www.example.org');
		$this->object->setPort('8888');
		$this->object->setFragment('someFragment');
		$this->object->setPath('/this/is/a/path/to/a/file');

		$this->assertThat(
			$this->object->toString(),
			$this->equalTo('ftp://root:secret@www.example.org:8888/this/is/a/path/to/a/file?somevar=somevalue&somevar2=somevalue2#someFragment')
		);
	}

	/**
	 * Test the setVar method.
	 *
	 * @return  void
	 *
	 * @since   11.1
	 * @covers  JUri::setVar
	 */
	public function testSetVar()
	{
		$this->object->setVar('somevar', 'somevalue');

		$this->assertThat(
			$this->object->getVar('somevar'),
			$this->equalTo('somevalue')
		);
	}

	/**
	 * Test the hasVar method.
	 *
	 * @return  void
	 *
	 * @since   11.1
	 * @covers  JUri::hasVar
	 */
	public function testHasVar()
	{
		$this->object->parse('http://someuser:somepass@www.example.com:80/path/file.html?var=value#fragment');

		$this->assertThat(
			$this->object->hasVar('somevar'),
			$this->equalTo(false)
		);

		$this->assertThat(
			$this->object->hasVar('var'),
			$this->equalTo(true)
		);
	}

	/**
	 * Test the getVar method.
	 *
	 * @return  void
	 *
	 * @since   11.1
	 * @covers  JUri::getVar
	 */
	public function testGetVar()
	{
		$this->object->parse('http://someuser:somepass@www.example.com:80/path/file.html?var=value#fragment');

		$this->assertThat(
			$this->object->getVar('var'),
			$this->equalTo('value')
		);

		$this->assertThat(
			$this->object->getVar('var2'),
			$this->equalTo('')
		);

		$this->assertThat(
			$this->object->getVar('var2', 'default'),
			$this->equalTo('default')
		);
	}

	/**
	 * Test the delVar method.
	 *
	 * @return  void
	 *
	 * @since   11.1
	 * @covers  JUri::delVar
	 */
	public function testDelVar()
	{
		$this->object->parse('http://someuser:somepass@www.example.com:80/path/file.html?var=value#fragment');

		$this->assertThat(
			$this->object->getVar('var'),
			$this->equalTo('value')
		);

		$this->object->delVar('var');

		$this->assertThat(
			$this->object->getVar('var'),
			$this->equalTo('')
		);
	}

	/**
	 * Test the setQuery method.
	 *
	 * @return  void
	 *
	 * @since   11.1
	 * @covers  JUri::setQuery
	 */
	public function testSetQuery()
	{
		$this->object->setQuery('somevar=somevalue');

		$this->assertThat(
			$this->object->getQuery(),
			$this->equalTo('somevar=somevalue')
		);

		$this->object->setQuery('somevar=somevalue&amp;test=true');

		$this->assertThat(
			$this->object->getQuery(),
			$this->equalTo('somevar=somevalue&test=true')
		);

		$this->object->setQuery(array('somevar' => 'somevalue', 'test' => 'true'));

		$this->assertThat(
			$this->object->getQuery(),
			$this->equalTo('somevar=somevalue&test=true')
		);
	}

	/**
	 * Test the getQuery method.
	 *
	 * @return  void
	 *
	 * @since   11.1
	 * @covers  JUri::getQuery
	 */
	public function testGetQuery()
	{
		$this->object->parse('http://someuser:somepass@www.example.com:80/path/file.html?var=value#fragment');

		$this->assertThat(
			$this->object->getQuery(),
			$this->equalTo('var=value')
		);

		$this->assertThat(
			$this->object->getQuery(true),
			$this->equalTo(array('var' => 'value'))
		);
	}

	/**
	 * Test the buildQuery method.
	 *
	 * @return  void
	 *
	 * @since   11.1
	 * @covers  JUri::buildQuery
	 */
	public function testBuildQuery()
	{
		$params = array(
			'field' => array(
				'price' => array(
					'from' => 5,
					'to' => 10,
				),
				'name' => 'foo'
			),
			'v' => 45);

		$expected = 'field[price][from]=5&field[price][to]=10&field[name]=foo&v=45';
		$this->assertEquals($expected, JUri::buildQuery($params));
	}

	/**
	 * Test the getScheme method.
	 *
	 * @return  void
	 *
	 * @since   11.1
	 * @covers  JUri::getScheme
	 */
	public function testGetScheme()
	{
		$this->object->parse('http://someuser:somepass@www.example.com:80/path/file.html?var=value#fragment');

		$this->assertThat(
			$this->object->getScheme(),
			$this->equalTo('http')
		);
	}

	/**
	 * Test the setScheme method.
	 *
	 * @return  void
	 *
	 * @since   11.1
	 * @covers  JUri::setScheme
	 */
	public function testSetScheme()
	{
		$this->object->setScheme('ftp');

		$this->assertThat(
			$this->object->getScheme(),
			$this->equalTo('ftp')
		);
	}

	/**
	 * Test the getUser method.
	 *
	 * @return  void
	 *
	 * @since   11.1
	 * @covers  JUri::getUser
	 */
	public function testGetUser()
	{
		$this->object->parse('http://someuser:somepass@www.example.com:80/path/file.html?var=value#fragment');

		$this->assertThat(
			$this->object->getUser(),
			$this->equalTo('someuser')
		);
	}

	/**
	 * Test the setUser method.
	 *
	 * @return  void
	 *
	 * @since   11.1
	 * @covers  JUri::setUser
	 */
	public function testSetUser()
	{
		$this->object->setUser('root');

		$this->assertThat(
			$this->object->getUser(),
			$this->equalTo('root')
		);
	}

	/**
	 * Test the getPass method.
	 *
	 * @return  void
	 *
	 * @since   11.1
	 * @covers  JUri::getPass
	 */
	public function testGetPass()
	{
		$this->object->parse('http://someuser:somepass@www.example.com:80/path/file.html?var=value#fragment');

		$this->assertThat(
			$this->object->getPass(),
			$this->equalTo('somepass')
		);
	}

	/**
	 * Test the setPass method.
	 *
	 * @return  void
	 *
	 * @since   11.1
	 * @covers  JUri::setPass
	 */
	public function testSetPass()
	{
		$this->object->setPass('secret');

		$this->assertThat(
			$this->object->getPass(),
			$this->equalTo('secret')
		);
	}

	/**
	 * Test the getHost method.
	 *
	 * @return  void
	 *
	 * @since   11.1
	 * @covers  JUri::getHost
	 */
	public function testGetHost()
	{
		$this->object->parse('http://someuser:somepass@www.example.com:80/path/file.html?var=value#fragment');

		$this->assertThat(
			$this->object->getHost(),
			$this->equalTo('www.example.com')
		);
	}

	/**
	 * Test the setHost method.
	 *
	 * @return  void
	 *
	 * @since   11.1
	 * @covers  JUri::setHost
	 */
	public function testSetHost()
	{
		$this->object->setHost('www.example.org');

		$this->assertThat(
			$this->object->getHost(),
			$this->equalTo('www.example.org')
		);
	}

	/**
	 * Test the getPort method.
	 *
	 * @return  void
	 *
	 * @since   11.1
	 * @covers  JUri::getPort
	 */
	public function testGetPort()
	{
		$this->object->parse('http://someuser:somepass@www.example.com:80/path/file.html?var=value#fragment');

		$this->assertThat(
			$this->object->getPort(),
			$this->equalTo('80')
		);
	}

	/**
	 * Test the setPort method.
	 *
	 * @return  void
	 *
	 * @since   11.1
	 * @covers  JUri::setPort
	 */
	public function testSetPort()
	{
		$this->object->setPort('8888');

		$this->assertThat(
			$this->object->getPort(),
			$this->equalTo('8888')
		);
	}

	/**
	 * Test the getPath method.
	 *
	 * @return  void
	 *
	 * @since   11.1
	 * @covers  JUri::getPath
	 */
	public function testGetPath()
	{
		$this->object->parse('http://someuser:somepass@www.example.com:80/path/file.html?var=value#fragment');

		$this->assertThat(
			$this->object->getPath(),
			$this->equalTo('/path/file.html')
		);
	}

	/**
	 * Test the setPath method.
	 *
	 * @return  void
	 *
	 * @since   11.1
	 * @covers  JUri::setPath
	 */
	public function testSetPath()
	{
		$this->object->setPath('/this/is/a/path/to/a/file.htm');

		$this->assertThat(
			$this->object->getPath(),
			$this->equalTo('/this/is/a/path/to/a/file.htm')
		);
	}

	/**
	 * Test the getFragment method.
	 *
	 * @return  void
	 *
	 * @since   11.1
	 * @covers  JUri::getFragment
	 */
	public function testGetFragment()
	{
		$this->object->parse('http://someuser:somepass@www.example.com:80/path/file.html?var=value#fragment');

		$this->assertThat(
			$this->object->getFragment(),
			$this->equalTo('fragment')
		);
	}

	/**
	 * Test the setFragment method.
	 *
	 * @return  void
	 *
	 * @since   11.1
	 * @covers  JUri::setFragment
	 */
	public function testSetFragment()
	{
		$this->object->setFragment('someFragment');

		$this->assertThat(
			$this->object->getFragment(),
			$this->equalTo('someFragment')
		);
	}

	/**
	 * Test the isSSL method.
	 *
	 * @return  void
	 *
	 * @since   11.1
	 * @covers  JUri::isSSL
	 */
	public function testIsSSL()
	{
		$this->object->parse('https://someuser:somepass@www.example.com:80/path/file.html?var=value#fragment');

		$this->assertThat(
			$this->object->isSSL(),
			$this->equalTo(true)
		);

		$this->object->parse('http://someuser:somepass@www.example.com:80/path/file.html?var=value#fragment');

		$this->assertThat(
			$this->object->isSSL(),
			$this->equalTo(false)
		);
	}
}
