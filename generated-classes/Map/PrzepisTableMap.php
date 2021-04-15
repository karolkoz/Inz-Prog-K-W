<?php

namespace Map;

use \Przepis;
use \PrzepisQuery;
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
 * This class defines the structure of the 'przepis' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class PrzepisTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.PrzepisTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'kulinaria';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'przepis';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Przepis';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Przepis';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 10;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 10;

    /**
     * the column name for the id_przepis field
     */
    const COL_ID_PRZEPIS = 'przepis.id_przepis';

    /**
     * the column name for the nazwa field
     */
    const COL_NAZWA = 'przepis.nazwa';

    /**
     * the column name for the stopien_trudnosci field
     */
    const COL_STOPIEN_TRUDNOSCI = 'przepis.stopien_trudnosci';

    /**
     * the column name for the czas_przygotowania field
     */
    const COL_CZAS_PRZYGOTOWANIA = 'przepis.czas_przygotowania';

    /**
     * the column name for the dla_ilu_osob field
     */
    const COL_DLA_ILU_OSOB = 'przepis.dla_ilu_osob';

    /**
     * the column name for the opis field
     */
    const COL_OPIS = 'przepis.opis';

    /**
     * the column name for the data_dodania field
     */
    const COL_DATA_DODANIA = 'przepis.data_dodania';

    /**
     * the column name for the status field
     */
    const COL_STATUS = 'przepis.status';

    /**
     * the column name for the zdjecie_ogolne field
     */
    const COL_ZDJECIE_OGOLNE = 'przepis.zdjecie_ogolne';

    /**
     * the column name for the UZYTKOWNIK_login field
     */
    const COL_UZYTKOWNIK_LOGIN = 'przepis.UZYTKOWNIK_login';

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
        self::TYPE_PHPNAME       => array('IdPrzepis', 'Nazwa', 'StopienTrudnosci', 'CzasPrzygotowania', 'DlaIluOsob', 'Opis', 'DataDodania', 'Status', 'ZdjecieOgolne', 'UzytkownikLogin', ),
        self::TYPE_CAMELNAME     => array('idPrzepis', 'nazwa', 'stopienTrudnosci', 'czasPrzygotowania', 'dlaIluOsob', 'opis', 'dataDodania', 'status', 'zdjecieOgolne', 'uzytkownikLogin', ),
        self::TYPE_COLNAME       => array(PrzepisTableMap::COL_ID_PRZEPIS, PrzepisTableMap::COL_NAZWA, PrzepisTableMap::COL_STOPIEN_TRUDNOSCI, PrzepisTableMap::COL_CZAS_PRZYGOTOWANIA, PrzepisTableMap::COL_DLA_ILU_OSOB, PrzepisTableMap::COL_OPIS, PrzepisTableMap::COL_DATA_DODANIA, PrzepisTableMap::COL_STATUS, PrzepisTableMap::COL_ZDJECIE_OGOLNE, PrzepisTableMap::COL_UZYTKOWNIK_LOGIN, ),
        self::TYPE_FIELDNAME     => array('id_przepis', 'nazwa', 'stopien_trudnosci', 'czas_przygotowania', 'dla_ilu_osob', 'opis', 'data_dodania', 'status', 'zdjecie_ogolne', 'UZYTKOWNIK_login', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('IdPrzepis' => 0, 'Nazwa' => 1, 'StopienTrudnosci' => 2, 'CzasPrzygotowania' => 3, 'DlaIluOsob' => 4, 'Opis' => 5, 'DataDodania' => 6, 'Status' => 7, 'ZdjecieOgolne' => 8, 'UzytkownikLogin' => 9, ),
        self::TYPE_CAMELNAME     => array('idPrzepis' => 0, 'nazwa' => 1, 'stopienTrudnosci' => 2, 'czasPrzygotowania' => 3, 'dlaIluOsob' => 4, 'opis' => 5, 'dataDodania' => 6, 'status' => 7, 'zdjecieOgolne' => 8, 'uzytkownikLogin' => 9, ),
        self::TYPE_COLNAME       => array(PrzepisTableMap::COL_ID_PRZEPIS => 0, PrzepisTableMap::COL_NAZWA => 1, PrzepisTableMap::COL_STOPIEN_TRUDNOSCI => 2, PrzepisTableMap::COL_CZAS_PRZYGOTOWANIA => 3, PrzepisTableMap::COL_DLA_ILU_OSOB => 4, PrzepisTableMap::COL_OPIS => 5, PrzepisTableMap::COL_DATA_DODANIA => 6, PrzepisTableMap::COL_STATUS => 7, PrzepisTableMap::COL_ZDJECIE_OGOLNE => 8, PrzepisTableMap::COL_UZYTKOWNIK_LOGIN => 9, ),
        self::TYPE_FIELDNAME     => array('id_przepis' => 0, 'nazwa' => 1, 'stopien_trudnosci' => 2, 'czas_przygotowania' => 3, 'dla_ilu_osob' => 4, 'opis' => 5, 'data_dodania' => 6, 'status' => 7, 'zdjecie_ogolne' => 8, 'UZYTKOWNIK_login' => 9, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
    );

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var string[]
     */
    protected $normalizedColumnNameMap = [

        'IdPrzepis' => 'ID_PRZEPIS',
        'Przepis.IdPrzepis' => 'ID_PRZEPIS',
        'idPrzepis' => 'ID_PRZEPIS',
        'przepis.idPrzepis' => 'ID_PRZEPIS',
        'PrzepisTableMap::COL_ID_PRZEPIS' => 'ID_PRZEPIS',
        'COL_ID_PRZEPIS' => 'ID_PRZEPIS',
        'id_przepis' => 'ID_PRZEPIS',
        'przepis.id_przepis' => 'ID_PRZEPIS',
        'Nazwa' => 'NAZWA',
        'Przepis.Nazwa' => 'NAZWA',
        'nazwa' => 'NAZWA',
        'przepis.nazwa' => 'NAZWA',
        'PrzepisTableMap::COL_NAZWA' => 'NAZWA',
        'COL_NAZWA' => 'NAZWA',
        'nazwa' => 'NAZWA',
        'przepis.nazwa' => 'NAZWA',
        'StopienTrudnosci' => 'STOPIEN_TRUDNOSCI',
        'Przepis.StopienTrudnosci' => 'STOPIEN_TRUDNOSCI',
        'stopienTrudnosci' => 'STOPIEN_TRUDNOSCI',
        'przepis.stopienTrudnosci' => 'STOPIEN_TRUDNOSCI',
        'PrzepisTableMap::COL_STOPIEN_TRUDNOSCI' => 'STOPIEN_TRUDNOSCI',
        'COL_STOPIEN_TRUDNOSCI' => 'STOPIEN_TRUDNOSCI',
        'stopien_trudnosci' => 'STOPIEN_TRUDNOSCI',
        'przepis.stopien_trudnosci' => 'STOPIEN_TRUDNOSCI',
        'CzasPrzygotowania' => 'CZAS_PRZYGOTOWANIA',
        'Przepis.CzasPrzygotowania' => 'CZAS_PRZYGOTOWANIA',
        'czasPrzygotowania' => 'CZAS_PRZYGOTOWANIA',
        'przepis.czasPrzygotowania' => 'CZAS_PRZYGOTOWANIA',
        'PrzepisTableMap::COL_CZAS_PRZYGOTOWANIA' => 'CZAS_PRZYGOTOWANIA',
        'COL_CZAS_PRZYGOTOWANIA' => 'CZAS_PRZYGOTOWANIA',
        'czas_przygotowania' => 'CZAS_PRZYGOTOWANIA',
        'przepis.czas_przygotowania' => 'CZAS_PRZYGOTOWANIA',
        'DlaIluOsob' => 'DLA_ILU_OSOB',
        'Przepis.DlaIluOsob' => 'DLA_ILU_OSOB',
        'dlaIluOsob' => 'DLA_ILU_OSOB',
        'przepis.dlaIluOsob' => 'DLA_ILU_OSOB',
        'PrzepisTableMap::COL_DLA_ILU_OSOB' => 'DLA_ILU_OSOB',
        'COL_DLA_ILU_OSOB' => 'DLA_ILU_OSOB',
        'dla_ilu_osob' => 'DLA_ILU_OSOB',
        'przepis.dla_ilu_osob' => 'DLA_ILU_OSOB',
        'Opis' => 'OPIS',
        'Przepis.Opis' => 'OPIS',
        'opis' => 'OPIS',
        'przepis.opis' => 'OPIS',
        'PrzepisTableMap::COL_OPIS' => 'OPIS',
        'COL_OPIS' => 'OPIS',
        'opis' => 'OPIS',
        'przepis.opis' => 'OPIS',
        'DataDodania' => 'DATA_DODANIA',
        'Przepis.DataDodania' => 'DATA_DODANIA',
        'dataDodania' => 'DATA_DODANIA',
        'przepis.dataDodania' => 'DATA_DODANIA',
        'PrzepisTableMap::COL_DATA_DODANIA' => 'DATA_DODANIA',
        'COL_DATA_DODANIA' => 'DATA_DODANIA',
        'data_dodania' => 'DATA_DODANIA',
        'przepis.data_dodania' => 'DATA_DODANIA',
        'Status' => 'STATUS',
        'Przepis.Status' => 'STATUS',
        'status' => 'STATUS',
        'przepis.status' => 'STATUS',
        'PrzepisTableMap::COL_STATUS' => 'STATUS',
        'COL_STATUS' => 'STATUS',
        'status' => 'STATUS',
        'przepis.status' => 'STATUS',
        'ZdjecieOgolne' => 'ZDJECIE_OGOLNE',
        'Przepis.ZdjecieOgolne' => 'ZDJECIE_OGOLNE',
        'zdjecieOgolne' => 'ZDJECIE_OGOLNE',
        'przepis.zdjecieOgolne' => 'ZDJECIE_OGOLNE',
        'PrzepisTableMap::COL_ZDJECIE_OGOLNE' => 'ZDJECIE_OGOLNE',
        'COL_ZDJECIE_OGOLNE' => 'ZDJECIE_OGOLNE',
        'zdjecie_ogolne' => 'ZDJECIE_OGOLNE',
        'przepis.zdjecie_ogolne' => 'ZDJECIE_OGOLNE',
        'UzytkownikLogin' => 'UZYTKOWNIK_LOGIN',
        'Przepis.UzytkownikLogin' => 'UZYTKOWNIK_LOGIN',
        'uzytkownikLogin' => 'UZYTKOWNIK_LOGIN',
        'przepis.uzytkownikLogin' => 'UZYTKOWNIK_LOGIN',
        'PrzepisTableMap::COL_UZYTKOWNIK_LOGIN' => 'UZYTKOWNIK_LOGIN',
        'COL_UZYTKOWNIK_LOGIN' => 'UZYTKOWNIK_LOGIN',
        'UZYTKOWNIK_login' => 'UZYTKOWNIK_LOGIN',
        'przepis.UZYTKOWNIK_login' => 'UZYTKOWNIK_LOGIN',
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
        $this->setName('przepis');
        $this->setPhpName('Przepis');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Przepis');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id_przepis', 'IdPrzepis', 'INTEGER', true, null, null);
        $this->addColumn('nazwa', 'Nazwa', 'VARCHAR', true, 40, null);
        $this->addColumn('stopien_trudnosci', 'StopienTrudnosci', 'INTEGER', true, null, null);
        $this->addColumn('czas_przygotowania', 'CzasPrzygotowania', 'INTEGER', true, null, null);
        $this->addColumn('dla_ilu_osob', 'DlaIluOsob', 'INTEGER', true, null, null);
        $this->addColumn('opis', 'Opis', 'VARCHAR', true, 10000, null);
        $this->addColumn('data_dodania', 'DataDodania', 'DATE', true, null, null);
        $this->addColumn('status', 'Status', 'INTEGER', true, null, null);
        $this->addColumn('zdjecie_ogolne', 'ZdjecieOgolne', 'BLOB', false, null, null);
        $this->addForeignKey('UZYTKOWNIK_login', 'UzytkownikLogin', 'VARCHAR', 'uzytkownik', 'login', true, 20, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Uzytkownik', '\\Uzytkownik', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':UZYTKOWNIK_login',
    1 => ':login',
  ),
), null, null, null, false);
        $this->addRelation('Etap', '\\Etap', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':PRZEPIS_id_przepis',
    1 => ':id_przepis',
  ),
), null, null, 'Etaps', false);
        $this->addRelation('Ulubione', '\\Ulubione', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':PRZEPIS_id_przepis',
    1 => ':id_przepis',
  ),
), null, null, 'Ulubiones', false);
        $this->addRelation('Lubie_to', '\\Lubie_to', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':PRZEPIS_id_przepis',
    1 => ':id_przepis',
  ),
), null, null, 'Lubie_tos', false);
        $this->addRelation('Nalezy', '\\Nalezy', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':PRZEPIS_id_przepis',
    1 => ':id_przepis',
  ),
), null, null, 'Nalezies', false);
        $this->addRelation('Zawiera', '\\Zawiera', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':PRZEPIS_id_przepis',
    1 => ':id_przepis',
  ),
), null, null, 'Zawieras', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPrzepis', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPrzepis', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPrzepis', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPrzepis', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPrzepis', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPrzepis', TableMap::TYPE_PHPNAME, $indexType)];
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
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('IdPrzepis', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? PrzepisTableMap::CLASS_DEFAULT : PrzepisTableMap::OM_CLASS;
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
     * @return array           (Przepis object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = PrzepisTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = PrzepisTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + PrzepisTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = PrzepisTableMap::OM_CLASS;
            /** @var Przepis $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            PrzepisTableMap::addInstanceToPool($obj, $key);
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
            $key = PrzepisTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = PrzepisTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Przepis $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                PrzepisTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(PrzepisTableMap::COL_ID_PRZEPIS);
            $criteria->addSelectColumn(PrzepisTableMap::COL_NAZWA);
            $criteria->addSelectColumn(PrzepisTableMap::COL_STOPIEN_TRUDNOSCI);
            $criteria->addSelectColumn(PrzepisTableMap::COL_CZAS_PRZYGOTOWANIA);
            $criteria->addSelectColumn(PrzepisTableMap::COL_DLA_ILU_OSOB);
            $criteria->addSelectColumn(PrzepisTableMap::COL_OPIS);
            $criteria->addSelectColumn(PrzepisTableMap::COL_DATA_DODANIA);
            $criteria->addSelectColumn(PrzepisTableMap::COL_STATUS);
            $criteria->addSelectColumn(PrzepisTableMap::COL_ZDJECIE_OGOLNE);
            $criteria->addSelectColumn(PrzepisTableMap::COL_UZYTKOWNIK_LOGIN);
        } else {
            $criteria->addSelectColumn($alias . '.id_przepis');
            $criteria->addSelectColumn($alias . '.nazwa');
            $criteria->addSelectColumn($alias . '.stopien_trudnosci');
            $criteria->addSelectColumn($alias . '.czas_przygotowania');
            $criteria->addSelectColumn($alias . '.dla_ilu_osob');
            $criteria->addSelectColumn($alias . '.opis');
            $criteria->addSelectColumn($alias . '.data_dodania');
            $criteria->addSelectColumn($alias . '.status');
            $criteria->addSelectColumn($alias . '.zdjecie_ogolne');
            $criteria->addSelectColumn($alias . '.UZYTKOWNIK_login');
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
            $criteria->removeSelectColumn(PrzepisTableMap::COL_ID_PRZEPIS);
            $criteria->removeSelectColumn(PrzepisTableMap::COL_NAZWA);
            $criteria->removeSelectColumn(PrzepisTableMap::COL_STOPIEN_TRUDNOSCI);
            $criteria->removeSelectColumn(PrzepisTableMap::COL_CZAS_PRZYGOTOWANIA);
            $criteria->removeSelectColumn(PrzepisTableMap::COL_DLA_ILU_OSOB);
            $criteria->removeSelectColumn(PrzepisTableMap::COL_OPIS);
            $criteria->removeSelectColumn(PrzepisTableMap::COL_DATA_DODANIA);
            $criteria->removeSelectColumn(PrzepisTableMap::COL_STATUS);
            $criteria->removeSelectColumn(PrzepisTableMap::COL_ZDJECIE_OGOLNE);
            $criteria->removeSelectColumn(PrzepisTableMap::COL_UZYTKOWNIK_LOGIN);
        } else {
            $criteria->removeSelectColumn($alias . '.id_przepis');
            $criteria->removeSelectColumn($alias . '.nazwa');
            $criteria->removeSelectColumn($alias . '.stopien_trudnosci');
            $criteria->removeSelectColumn($alias . '.czas_przygotowania');
            $criteria->removeSelectColumn($alias . '.dla_ilu_osob');
            $criteria->removeSelectColumn($alias . '.opis');
            $criteria->removeSelectColumn($alias . '.data_dodania');
            $criteria->removeSelectColumn($alias . '.status');
            $criteria->removeSelectColumn($alias . '.zdjecie_ogolne');
            $criteria->removeSelectColumn($alias . '.UZYTKOWNIK_login');
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
        return Propel::getServiceContainer()->getDatabaseMap(PrzepisTableMap::DATABASE_NAME)->getTable(PrzepisTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(PrzepisTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(PrzepisTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new PrzepisTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Przepis or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Przepis object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(PrzepisTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Przepis) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(PrzepisTableMap::DATABASE_NAME);
            $criteria->add(PrzepisTableMap::COL_ID_PRZEPIS, (array) $values, Criteria::IN);
        }

        $query = PrzepisQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            PrzepisTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                PrzepisTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the przepis table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return PrzepisQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Przepis or Criteria object.
     *
     * @param mixed               $criteria Criteria or Przepis object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PrzepisTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Przepis object
        }

        if ($criteria->containsKey(PrzepisTableMap::COL_ID_PRZEPIS) && $criteria->keyContainsValue(PrzepisTableMap::COL_ID_PRZEPIS) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.PrzepisTableMap::COL_ID_PRZEPIS.')');
        }


        // Set the correct dbName
        $query = PrzepisQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // PrzepisTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
PrzepisTableMap::buildTableMap();
