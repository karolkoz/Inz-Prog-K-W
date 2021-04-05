<?php

namespace Map;

use \Uzytkownik;
use \UzytkownikQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'uzytkownik' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class UzytkownikTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.UzytkownikTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'kulinaria';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'uzytkownik';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Uzytkownik';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Uzytkownik';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 5;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 5;

    /**
     * the column name for the login field
     */
    const COL_LOGIN = 'uzytkownik.login';

    /**
     * the column name for the nazwa field
     */
    const COL_NAZWA = 'uzytkownik.nazwa';

    /**
     * the column name for the haslo field
     */
    const COL_HASLO = 'uzytkownik.haslo';

    /**
     * the column name for the rodzaj_konta field
     */
    const COL_RODZAJ_KONTA = 'uzytkownik.rodzaj_konta';

    /**
     * the column name for the status_konta field
     */
    const COL_STATUS_KONTA = 'uzytkownik.status_konta';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Login', 'Nazwa', 'Haslo', 'RodzajKonta', 'StatusKonta', ),
        self::TYPE_CAMELNAME     => array('login', 'nazwa', 'haslo', 'rodzajKonta', 'statusKonta', ),
        self::TYPE_COLNAME       => array(UzytkownikTableMap::COL_LOGIN, UzytkownikTableMap::COL_NAZWA, UzytkownikTableMap::COL_HASLO, UzytkownikTableMap::COL_RODZAJ_KONTA, UzytkownikTableMap::COL_STATUS_KONTA, ),
        self::TYPE_FIELDNAME     => array('login', 'nazwa', 'haslo', 'rodzaj_konta', 'status_konta', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Login' => 0, 'Nazwa' => 1, 'Haslo' => 2, 'RodzajKonta' => 3, 'StatusKonta' => 4, ),
        self::TYPE_CAMELNAME     => array('login' => 0, 'nazwa' => 1, 'haslo' => 2, 'rodzajKonta' => 3, 'statusKonta' => 4, ),
        self::TYPE_COLNAME       => array(UzytkownikTableMap::COL_LOGIN => 0, UzytkownikTableMap::COL_NAZWA => 1, UzytkownikTableMap::COL_HASLO => 2, UzytkownikTableMap::COL_RODZAJ_KONTA => 3, UzytkownikTableMap::COL_STATUS_KONTA => 4, ),
        self::TYPE_FIELDNAME     => array('login' => 0, 'nazwa' => 1, 'haslo' => 2, 'rodzaj_konta' => 3, 'status_konta' => 4, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
    );

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var string[]
     */
    protected $normalizedColumnNameMap = [

        'Login' => 'LOGIN',
        'Uzytkownik.Login' => 'LOGIN',
        'login' => 'LOGIN',
        'uzytkownik.login' => 'LOGIN',
        'UzytkownikTableMap::COL_LOGIN' => 'LOGIN',
        'COL_LOGIN' => 'LOGIN',
        'login' => 'LOGIN',
        'uzytkownik.login' => 'LOGIN',
        'Nazwa' => 'NAZWA',
        'Uzytkownik.Nazwa' => 'NAZWA',
        'nazwa' => 'NAZWA',
        'uzytkownik.nazwa' => 'NAZWA',
        'UzytkownikTableMap::COL_NAZWA' => 'NAZWA',
        'COL_NAZWA' => 'NAZWA',
        'nazwa' => 'NAZWA',
        'uzytkownik.nazwa' => 'NAZWA',
        'Haslo' => 'HASLO',
        'Uzytkownik.Haslo' => 'HASLO',
        'haslo' => 'HASLO',
        'uzytkownik.haslo' => 'HASLO',
        'UzytkownikTableMap::COL_HASLO' => 'HASLO',
        'COL_HASLO' => 'HASLO',
        'haslo' => 'HASLO',
        'uzytkownik.haslo' => 'HASLO',
        'RodzajKonta' => 'RODZAJ_KONTA',
        'Uzytkownik.RodzajKonta' => 'RODZAJ_KONTA',
        'rodzajKonta' => 'RODZAJ_KONTA',
        'uzytkownik.rodzajKonta' => 'RODZAJ_KONTA',
        'UzytkownikTableMap::COL_RODZAJ_KONTA' => 'RODZAJ_KONTA',
        'COL_RODZAJ_KONTA' => 'RODZAJ_KONTA',
        'rodzaj_konta' => 'RODZAJ_KONTA',
        'uzytkownik.rodzaj_konta' => 'RODZAJ_KONTA',
        'StatusKonta' => 'STATUS_KONTA',
        'Uzytkownik.StatusKonta' => 'STATUS_KONTA',
        'statusKonta' => 'STATUS_KONTA',
        'uzytkownik.statusKonta' => 'STATUS_KONTA',
        'UzytkownikTableMap::COL_STATUS_KONTA' => 'STATUS_KONTA',
        'COL_STATUS_KONTA' => 'STATUS_KONTA',
        'status_konta' => 'STATUS_KONTA',
        'uzytkownik.status_konta' => 'STATUS_KONTA',
    ];

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('uzytkownik');
        $this->setPhpName('Uzytkownik');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Uzytkownik');
        $this->setPackage('');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('login', 'Login', 'VARCHAR', true, 20, null);
        $this->addColumn('nazwa', 'Nazwa', 'VARCHAR', true, 20, null);
        $this->addColumn('haslo', 'Haslo', 'VARCHAR', true, 20, null);
        $this->addColumn('rodzaj_konta', 'RodzajKonta', 'INTEGER', true, null, null);
        $this->addColumn('status_konta', 'StatusKonta', 'INTEGER', true, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('UZYTKOWNIK_login', '\\Przepis', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':UZYTKOWNIK_login',
    1 => ':login',
  ),
), null, null, 'UZYTKOWNIK_logins', false);
        $this->addRelation('UZYTKOWNIK_login', '\\Ulubione', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':UZYTKOWNIK_login',
    1 => ':login',
  ),
), null, null, 'UZYTKOWNIK_logins', false);
        $this->addRelation('UZYTKOWNIK_login', '\\Lubie_to', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':UZYTKOWNIK_login',
    1 => ':login',
  ),
), null, null, 'UZYTKOWNIK_logins', false);
    } // buildRelations()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Login', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Login', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Login', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Login', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Login', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Login', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (string) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Login', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? UzytkownikTableMap::CLASS_DEFAULT : UzytkownikTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (Uzytkownik object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = UzytkownikTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = UzytkownikTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + UzytkownikTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = UzytkownikTableMap::OM_CLASS;
            /** @var Uzytkownik $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            UzytkownikTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = UzytkownikTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = UzytkownikTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Uzytkownik $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                UzytkownikTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(UzytkownikTableMap::COL_LOGIN);
            $criteria->addSelectColumn(UzytkownikTableMap::COL_NAZWA);
            $criteria->addSelectColumn(UzytkownikTableMap::COL_HASLO);
            $criteria->addSelectColumn(UzytkownikTableMap::COL_RODZAJ_KONTA);
            $criteria->addSelectColumn(UzytkownikTableMap::COL_STATUS_KONTA);
        } else {
            $criteria->addSelectColumn($alias . '.login');
            $criteria->addSelectColumn($alias . '.nazwa');
            $criteria->addSelectColumn($alias . '.haslo');
            $criteria->addSelectColumn($alias . '.rodzaj_konta');
            $criteria->addSelectColumn($alias . '.status_konta');
        }
    }

    /**
     * Remove all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be removed as they are only loaded on demand.
     *
     * @param Criteria $criteria object containing the columns to remove.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function removeSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->removeSelectColumn(UzytkownikTableMap::COL_LOGIN);
            $criteria->removeSelectColumn(UzytkownikTableMap::COL_NAZWA);
            $criteria->removeSelectColumn(UzytkownikTableMap::COL_HASLO);
            $criteria->removeSelectColumn(UzytkownikTableMap::COL_RODZAJ_KONTA);
            $criteria->removeSelectColumn(UzytkownikTableMap::COL_STATUS_KONTA);
        } else {
            $criteria->removeSelectColumn($alias . '.login');
            $criteria->removeSelectColumn($alias . '.nazwa');
            $criteria->removeSelectColumn($alias . '.haslo');
            $criteria->removeSelectColumn($alias . '.rodzaj_konta');
            $criteria->removeSelectColumn($alias . '.status_konta');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(UzytkownikTableMap::DATABASE_NAME)->getTable(UzytkownikTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(UzytkownikTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(UzytkownikTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new UzytkownikTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Uzytkownik or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Uzytkownik object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UzytkownikTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Uzytkownik) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(UzytkownikTableMap::DATABASE_NAME);
            $criteria->add(UzytkownikTableMap::COL_LOGIN, (array) $values, Criteria::IN);
        }

        $query = UzytkownikQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            UzytkownikTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                UzytkownikTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the uzytkownik table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return UzytkownikQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Uzytkownik or Criteria object.
     *
     * @param mixed               $criteria Criteria or Uzytkownik object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UzytkownikTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Uzytkownik object
        }


        // Set the correct dbName
        $query = UzytkownikQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // UzytkownikTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
UzytkownikTableMap::buildTableMap();
