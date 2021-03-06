<?php

namespace Base;

use \Etap as ChildEtap;
use \EtapQuery as ChildEtapQuery;
use \Lubie_to as ChildLubie_to;
use \Lubie_toQuery as ChildLubie_toQuery;
use \Nalezy as ChildNalezy;
use \NalezyQuery as ChildNalezyQuery;
use \Przepis as ChildPrzepis;
use \PrzepisQuery as ChildPrzepisQuery;
use \Ulubione as ChildUlubione;
use \UlubioneQuery as ChildUlubioneQuery;
use \Uzytkownik as ChildUzytkownik;
use \UzytkownikQuery as ChildUzytkownikQuery;
use \Zawiera as ChildZawiera;
use \ZawieraQuery as ChildZawieraQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\EtapTableMap;
use Map\Lubie_toTableMap;
use Map\NalezyTableMap;
use Map\PrzepisTableMap;
use Map\UlubioneTableMap;
use Map\ZawieraTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;

/**
 * Base class that represents a row from the 'przepis' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class Przepis implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\PrzepisTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the id_przepis field.
     *
     * @var        int
     */
    protected $id_przepis;

    /**
     * The value for the nazwa field.
     *
     * @var        string
     */
    protected $nazwa;

    /**
     * The value for the stopien_trudnosci field.
     *
     * @var        int
     */
    protected $stopien_trudnosci;

    /**
     * The value for the czas_przygotowania field.
     *
     * @var        int
     */
    protected $czas_przygotowania;

    /**
     * The value for the dla_ilu_osob field.
     *
     * @var        int
     */
    protected $dla_ilu_osob;

    /**
     * The value for the opis field.
     *
     * @var        string
     */
    protected $opis;

    /**
     * The value for the data_dodania field.
     *
     * @var        DateTime
     */
    protected $data_dodania;

    /**
     * The value for the status field.
     *
     * @var        int
     */
    protected $status;

    /**
     * The value for the zdjecie_ogolne field.
     *
     * @var        string|null
     */
    protected $zdjecie_ogolne;

    /**
     * The value for the uzytkownik_login field.
     *
     * @var        string
     */
    protected $uzytkownik_login;

    /**
     * @var        ChildUzytkownik
     */
    protected $aUzytkownik;

    /**
     * @var        ObjectCollection|ChildEtap[] Collection to store aggregation of ChildEtap objects.
     */
    protected $collEtaps;
    protected $collEtapsPartial;

    /**
     * @var        ObjectCollection|ChildUlubione[] Collection to store aggregation of ChildUlubione objects.
     */
    protected $collUlubiones;
    protected $collUlubionesPartial;

    /**
     * @var        ObjectCollection|ChildLubie_to[] Collection to store aggregation of ChildLubie_to objects.
     */
    protected $collLubie_tos;
    protected $collLubie_tosPartial;

    /**
     * @var        ObjectCollection|ChildNalezy[] Collection to store aggregation of ChildNalezy objects.
     */
    protected $collNalezies;
    protected $collNaleziesPartial;

    /**
     * @var        ObjectCollection|ChildZawiera[] Collection to store aggregation of ChildZawiera objects.
     */
    protected $collZawieras;
    protected $collZawierasPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildEtap[]
     */
    protected $etapsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildUlubione[]
     */
    protected $ulubionesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildLubie_to[]
     */
    protected $lubie_tosScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildNalezy[]
     */
    protected $naleziesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildZawiera[]
     */
    protected $zawierasScheduledForDeletion = null;

    /**
     * Initializes internal state of Base\Przepis object.
     */
    public function __construct()
    {
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>Przepis</code> instance.  If
     * <code>obj</code> is an instance of <code>Przepis</code>, delegates to
     * <code>equals(Przepis)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return void
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @param  string  $keyType                (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME, TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM. Defaults to TableMap::TYPE_PHPNAME.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray($keyType, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [id_przepis] column value.
     *
     * @return int
     */
    public function getIdPrzepis()
    {
        return $this->id_przepis;
    }

    /**
     * Get the [nazwa] column value.
     *
     * @return string
     */
    public function getNazwa()
    {
        return $this->nazwa;
    }

    /**
     * Get the [stopien_trudnosci] column value.
     *
     * @return int
     */
    public function getStopienTrudnosci()
    {
        return $this->stopien_trudnosci;
    }

    /**
     * Get the [czas_przygotowania] column value.
     *
     * @return int
     */
    public function getCzasPrzygotowania()
    {
        return $this->czas_przygotowania;
    }

    /**
     * Get the [dla_ilu_osob] column value.
     *
     * @return int
     */
    public function getDlaIluOsob()
    {
        return $this->dla_ilu_osob;
    }

    /**
     * Get the [opis] column value.
     *
     * @return string
     */
    public function getOpis()
    {
        return $this->opis;
    }

    /**
     * Get the [optionally formatted] temporal [data_dodania] column value.
     *
     *
     * @param string|null $format The date/time format string (either date()-style or strftime()-style).
     *   If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     *
     * @psalm-return ($format is null ? DateTime : string)
     */
    public function getDataDodania($format = null)
    {
        if ($format === null) {
            return $this->data_dodania;
        } else {
            return $this->data_dodania instanceof \DateTimeInterface ? $this->data_dodania->format($format) : null;
        }
    }

    /**
     * Get the [status] column value.
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get the [zdjecie_ogolne] column value.
     *
     * @return string|null
     */
    public function getZdjecieOgolne()
    {
        return $this->zdjecie_ogolne;
    }

    /**
     * Get the [uzytkownik_login] column value.
     *
     * @return string
     */
    public function getUzytkownikLogin()
    {
        return $this->uzytkownik_login;
    }

    /**
     * Set the value of [id_przepis] column.
     *
     * @param int $v New value
     * @return $this|\Przepis The current object (for fluent API support)
     */
    public function setIdPrzepis($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_przepis !== $v) {
            $this->id_przepis = $v;
            $this->modifiedColumns[PrzepisTableMap::COL_ID_PRZEPIS] = true;
        }

        return $this;
    } // setIdPrzepis()

    /**
     * Set the value of [nazwa] column.
     *
     * @param string $v New value
     * @return $this|\Przepis The current object (for fluent API support)
     */
    public function setNazwa($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->nazwa !== $v) {
            $this->nazwa = $v;
            $this->modifiedColumns[PrzepisTableMap::COL_NAZWA] = true;
        }

        return $this;
    } // setNazwa()

    /**
     * Set the value of [stopien_trudnosci] column.
     *
     * @param int $v New value
     * @return $this|\Przepis The current object (for fluent API support)
     */
    public function setStopienTrudnosci($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->stopien_trudnosci !== $v) {
            $this->stopien_trudnosci = $v;
            $this->modifiedColumns[PrzepisTableMap::COL_STOPIEN_TRUDNOSCI] = true;
        }

        return $this;
    } // setStopienTrudnosci()

    /**
     * Set the value of [czas_przygotowania] column.
     *
     * @param int $v New value
     * @return $this|\Przepis The current object (for fluent API support)
     */
    public function setCzasPrzygotowania($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->czas_przygotowania !== $v) {
            $this->czas_przygotowania = $v;
            $this->modifiedColumns[PrzepisTableMap::COL_CZAS_PRZYGOTOWANIA] = true;
        }

        return $this;
    } // setCzasPrzygotowania()

    /**
     * Set the value of [dla_ilu_osob] column.
     *
     * @param int $v New value
     * @return $this|\Przepis The current object (for fluent API support)
     */
    public function setDlaIluOsob($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->dla_ilu_osob !== $v) {
            $this->dla_ilu_osob = $v;
            $this->modifiedColumns[PrzepisTableMap::COL_DLA_ILU_OSOB] = true;
        }

        return $this;
    } // setDlaIluOsob()

    /**
     * Set the value of [opis] column.
     *
     * @param string $v New value
     * @return $this|\Przepis The current object (for fluent API support)
     */
    public function setOpis($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->opis !== $v) {
            $this->opis = $v;
            $this->modifiedColumns[PrzepisTableMap::COL_OPIS] = true;
        }

        return $this;
    } // setOpis()

    /**
     * Sets the value of [data_dodania] column to a normalized version of the date/time value specified.
     *
     * @param  string|integer|\DateTimeInterface $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Przepis The current object (for fluent API support)
     */
    public function setDataDodania($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->data_dodania !== null || $dt !== null) {
            if ($this->data_dodania === null || $dt === null || $dt->format("Y-m-d") !== $this->data_dodania->format("Y-m-d")) {
                $this->data_dodania = $dt === null ? null : clone $dt;
                $this->modifiedColumns[PrzepisTableMap::COL_DATA_DODANIA] = true;
            }
        } // if either are not null

        return $this;
    } // setDataDodania()

    /**
     * Set the value of [status] column.
     *
     * @param int $v New value
     * @return $this|\Przepis The current object (for fluent API support)
     */
    public function setStatus($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->status !== $v) {
            $this->status = $v;
            $this->modifiedColumns[PrzepisTableMap::COL_STATUS] = true;
        }

        return $this;
    } // setStatus()

    /**
     * Set the value of [zdjecie_ogolne] column.
     *
     * @param string|null $v New value
     * @return $this|\Przepis The current object (for fluent API support)
     */
    public function setZdjecieOgolne($v)
    {
        // Because BLOB columns are streams in PDO we have to assume that they are
        // always modified when a new value is passed in.  For example, the contents
        // of the stream itself may have changed externally.
        if (!is_resource($v) && $v !== null) {
            $this->zdjecie_ogolne = fopen('php://memory', 'r+');
            fwrite($this->zdjecie_ogolne, $v);
            rewind($this->zdjecie_ogolne);
        } else { // it's already a stream
            $this->zdjecie_ogolne = $v;
        }
        $this->modifiedColumns[PrzepisTableMap::COL_ZDJECIE_OGOLNE] = true;

        return $this;
    } // setZdjecieOgolne()

    /**
     * Set the value of [uzytkownik_login] column.
     *
     * @param string $v New value
     * @return $this|\Przepis The current object (for fluent API support)
     */
    public function setUzytkownikLogin($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->uzytkownik_login !== $v) {
            $this->uzytkownik_login = $v;
            $this->modifiedColumns[PrzepisTableMap::COL_UZYTKOWNIK_LOGIN] = true;
        }

        if ($this->aUzytkownik !== null && $this->aUzytkownik->getLogin() !== $v) {
            $this->aUzytkownik = null;
        }

        return $this;
    } // setUzytkownikLogin()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : PrzepisTableMap::translateFieldName('IdPrzepis', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_przepis = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : PrzepisTableMap::translateFieldName('Nazwa', TableMap::TYPE_PHPNAME, $indexType)];
            $this->nazwa = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : PrzepisTableMap::translateFieldName('StopienTrudnosci', TableMap::TYPE_PHPNAME, $indexType)];
            $this->stopien_trudnosci = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : PrzepisTableMap::translateFieldName('CzasPrzygotowania', TableMap::TYPE_PHPNAME, $indexType)];
            $this->czas_przygotowania = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : PrzepisTableMap::translateFieldName('DlaIluOsob', TableMap::TYPE_PHPNAME, $indexType)];
            $this->dla_ilu_osob = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : PrzepisTableMap::translateFieldName('Opis', TableMap::TYPE_PHPNAME, $indexType)];
            $this->opis = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : PrzepisTableMap::translateFieldName('DataDodania', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->data_dodania = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : PrzepisTableMap::translateFieldName('Status', TableMap::TYPE_PHPNAME, $indexType)];
            $this->status = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : PrzepisTableMap::translateFieldName('ZdjecieOgolne', TableMap::TYPE_PHPNAME, $indexType)];
            if (null !== $col) {
                $this->zdjecie_ogolne = fopen('php://memory', 'r+');
                fwrite($this->zdjecie_ogolne, $col);
                rewind($this->zdjecie_ogolne);
            } else {
                $this->zdjecie_ogolne = null;
            }

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : PrzepisTableMap::translateFieldName('UzytkownikLogin', TableMap::TYPE_PHPNAME, $indexType)];
            $this->uzytkownik_login = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 10; // 10 = PrzepisTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Przepis'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
        if ($this->aUzytkownik !== null && $this->uzytkownik_login !== $this->aUzytkownik->getLogin()) {
            $this->aUzytkownik = null;
        }
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PrzepisTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildPrzepisQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aUzytkownik = null;
            $this->collEtaps = null;

            $this->collUlubiones = null;

            $this->collLubie_tos = null;

            $this->collNalezies = null;

            $this->collZawieras = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Przepis::setDeleted()
     * @see Przepis::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(PrzepisTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildPrzepisQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($this->alreadyInSave) {
            return 0;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(PrzepisTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                PrzepisTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aUzytkownik !== null) {
                if ($this->aUzytkownik->isModified() || $this->aUzytkownik->isNew()) {
                    $affectedRows += $this->aUzytkownik->save($con);
                }
                $this->setUzytkownik($this->aUzytkownik);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                // Rewind the zdjecie_ogolne LOB column, since PDO does not rewind after inserting value.
                if ($this->zdjecie_ogolne !== null && is_resource($this->zdjecie_ogolne)) {
                    rewind($this->zdjecie_ogolne);
                }

                $this->resetModified();
            }

            if ($this->etapsScheduledForDeletion !== null) {
                if (!$this->etapsScheduledForDeletion->isEmpty()) {
                    \EtapQuery::create()
                        ->filterByPrimaryKeys($this->etapsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->etapsScheduledForDeletion = null;
                }
            }

            if ($this->collEtaps !== null) {
                foreach ($this->collEtaps as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->ulubionesScheduledForDeletion !== null) {
                if (!$this->ulubionesScheduledForDeletion->isEmpty()) {
                    \UlubioneQuery::create()
                        ->filterByPrimaryKeys($this->ulubionesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->ulubionesScheduledForDeletion = null;
                }
            }

            if ($this->collUlubiones !== null) {
                foreach ($this->collUlubiones as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->lubie_tosScheduledForDeletion !== null) {
                if (!$this->lubie_tosScheduledForDeletion->isEmpty()) {
                    \Lubie_toQuery::create()
                        ->filterByPrimaryKeys($this->lubie_tosScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->lubie_tosScheduledForDeletion = null;
                }
            }

            if ($this->collLubie_tos !== null) {
                foreach ($this->collLubie_tos as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->naleziesScheduledForDeletion !== null) {
                if (!$this->naleziesScheduledForDeletion->isEmpty()) {
                    \NalezyQuery::create()
                        ->filterByPrimaryKeys($this->naleziesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->naleziesScheduledForDeletion = null;
                }
            }

            if ($this->collNalezies !== null) {
                foreach ($this->collNalezies as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->zawierasScheduledForDeletion !== null) {
                if (!$this->zawierasScheduledForDeletion->isEmpty()) {
                    \ZawieraQuery::create()
                        ->filterByPrimaryKeys($this->zawierasScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->zawierasScheduledForDeletion = null;
                }
            }

            if ($this->collZawieras !== null) {
                foreach ($this->collZawieras as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[PrzepisTableMap::COL_ID_PRZEPIS] = true;
        if (null !== $this->id_przepis) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . PrzepisTableMap::COL_ID_PRZEPIS . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(PrzepisTableMap::COL_ID_PRZEPIS)) {
            $modifiedColumns[':p' . $index++]  = 'id_przepis';
        }
        if ($this->isColumnModified(PrzepisTableMap::COL_NAZWA)) {
            $modifiedColumns[':p' . $index++]  = 'nazwa';
        }
        if ($this->isColumnModified(PrzepisTableMap::COL_STOPIEN_TRUDNOSCI)) {
            $modifiedColumns[':p' . $index++]  = 'stopien_trudnosci';
        }
        if ($this->isColumnModified(PrzepisTableMap::COL_CZAS_PRZYGOTOWANIA)) {
            $modifiedColumns[':p' . $index++]  = 'czas_przygotowania';
        }
        if ($this->isColumnModified(PrzepisTableMap::COL_DLA_ILU_OSOB)) {
            $modifiedColumns[':p' . $index++]  = 'dla_ilu_osob';
        }
        if ($this->isColumnModified(PrzepisTableMap::COL_OPIS)) {
            $modifiedColumns[':p' . $index++]  = 'opis';
        }
        if ($this->isColumnModified(PrzepisTableMap::COL_DATA_DODANIA)) {
            $modifiedColumns[':p' . $index++]  = 'data_dodania';
        }
        if ($this->isColumnModified(PrzepisTableMap::COL_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'status';
        }
        if ($this->isColumnModified(PrzepisTableMap::COL_ZDJECIE_OGOLNE)) {
            $modifiedColumns[':p' . $index++]  = 'zdjecie_ogolne';
        }
        if ($this->isColumnModified(PrzepisTableMap::COL_UZYTKOWNIK_LOGIN)) {
            $modifiedColumns[':p' . $index++]  = 'UZYTKOWNIK_login';
        }

        $sql = sprintf(
            'INSERT INTO przepis (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id_przepis':
                        $stmt->bindValue($identifier, $this->id_przepis, PDO::PARAM_INT);
                        break;
                    case 'nazwa':
                        $stmt->bindValue($identifier, $this->nazwa, PDO::PARAM_STR);
                        break;
                    case 'stopien_trudnosci':
                        $stmt->bindValue($identifier, $this->stopien_trudnosci, PDO::PARAM_INT);
                        break;
                    case 'czas_przygotowania':
                        $stmt->bindValue($identifier, $this->czas_przygotowania, PDO::PARAM_INT);
                        break;
                    case 'dla_ilu_osob':
                        $stmt->bindValue($identifier, $this->dla_ilu_osob, PDO::PARAM_INT);
                        break;
                    case 'opis':
                        $stmt->bindValue($identifier, $this->opis, PDO::PARAM_STR);
                        break;
                    case 'data_dodania':
                        $stmt->bindValue($identifier, $this->data_dodania ? $this->data_dodania->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'status':
                        $stmt->bindValue($identifier, $this->status, PDO::PARAM_INT);
                        break;
                    case 'zdjecie_ogolne':
                        if (is_resource($this->zdjecie_ogolne)) {
                            rewind($this->zdjecie_ogolne);
                        }
                        $stmt->bindValue($identifier, $this->zdjecie_ogolne, PDO::PARAM_LOB);
                        break;
                    case 'UZYTKOWNIK_login':
                        $stmt->bindValue($identifier, $this->uzytkownik_login, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setIdPrzepis($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = PrzepisTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getIdPrzepis();
                break;
            case 1:
                return $this->getNazwa();
                break;
            case 2:
                return $this->getStopienTrudnosci();
                break;
            case 3:
                return $this->getCzasPrzygotowania();
                break;
            case 4:
                return $this->getDlaIluOsob();
                break;
            case 5:
                return $this->getOpis();
                break;
            case 6:
                return $this->getDataDodania();
                break;
            case 7:
                return $this->getStatus();
                break;
            case 8:
                return $this->getZdjecieOgolne();
                break;
            case 9:
                return $this->getUzytkownikLogin();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {

        if (isset($alreadyDumpedObjects['Przepis'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Przepis'][$this->hashCode()] = true;
        $keys = PrzepisTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getIdPrzepis(),
            $keys[1] => $this->getNazwa(),
            $keys[2] => $this->getStopienTrudnosci(),
            $keys[3] => $this->getCzasPrzygotowania(),
            $keys[4] => $this->getDlaIluOsob(),
            $keys[5] => $this->getOpis(),
            $keys[6] => $this->getDataDodania(),
            $keys[7] => $this->getStatus(),
            $keys[8] => $this->getZdjecieOgolne(),
            $keys[9] => $this->getUzytkownikLogin(),
        );
        if ($result[$keys[6]] instanceof \DateTimeInterface) {
            $result[$keys[6]] = $result[$keys[6]]->format('Y-m-d');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aUzytkownik) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'uzytkownik';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'uzytkownik';
                        break;
                    default:
                        $key = 'Uzytkownik';
                }

                $result[$key] = $this->aUzytkownik->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collEtaps) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'etaps';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'etaps';
                        break;
                    default:
                        $key = 'Etaps';
                }

                $result[$key] = $this->collEtaps->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collUlubiones) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'ulubiones';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'ulubiones';
                        break;
                    default:
                        $key = 'Ulubiones';
                }

                $result[$key] = $this->collUlubiones->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collLubie_tos) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'lubie_tos';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'lubie_tos';
                        break;
                    default:
                        $key = 'Lubie_tos';
                }

                $result[$key] = $this->collLubie_tos->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collNalezies) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'nalezies';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'nalezies';
                        break;
                    default:
                        $key = 'Nalezies';
                }

                $result[$key] = $this->collNalezies->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collZawieras) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'zawieras';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'zawieras';
                        break;
                    default:
                        $key = 'Zawieras';
                }

                $result[$key] = $this->collZawieras->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\Przepis
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = PrzepisTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Przepis
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setIdPrzepis($value);
                break;
            case 1:
                $this->setNazwa($value);
                break;
            case 2:
                $this->setStopienTrudnosci($value);
                break;
            case 3:
                $this->setCzasPrzygotowania($value);
                break;
            case 4:
                $this->setDlaIluOsob($value);
                break;
            case 5:
                $this->setOpis($value);
                break;
            case 6:
                $this->setDataDodania($value);
                break;
            case 7:
                $this->setStatus($value);
                break;
            case 8:
                $this->setZdjecieOgolne($value);
                break;
            case 9:
                $this->setUzytkownikLogin($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return     $this|\Przepis
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = PrzepisTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdPrzepis($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setNazwa($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setStopienTrudnosci($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setCzasPrzygotowania($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setDlaIluOsob($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setOpis($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setDataDodania($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setStatus($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setZdjecieOgolne($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setUzytkownikLogin($arr[$keys[9]]);
        }

        return $this;
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\Przepis The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(PrzepisTableMap::DATABASE_NAME);

        if ($this->isColumnModified(PrzepisTableMap::COL_ID_PRZEPIS)) {
            $criteria->add(PrzepisTableMap::COL_ID_PRZEPIS, $this->id_przepis);
        }
        if ($this->isColumnModified(PrzepisTableMap::COL_NAZWA)) {
            $criteria->add(PrzepisTableMap::COL_NAZWA, $this->nazwa);
        }
        if ($this->isColumnModified(PrzepisTableMap::COL_STOPIEN_TRUDNOSCI)) {
            $criteria->add(PrzepisTableMap::COL_STOPIEN_TRUDNOSCI, $this->stopien_trudnosci);
        }
        if ($this->isColumnModified(PrzepisTableMap::COL_CZAS_PRZYGOTOWANIA)) {
            $criteria->add(PrzepisTableMap::COL_CZAS_PRZYGOTOWANIA, $this->czas_przygotowania);
        }
        if ($this->isColumnModified(PrzepisTableMap::COL_DLA_ILU_OSOB)) {
            $criteria->add(PrzepisTableMap::COL_DLA_ILU_OSOB, $this->dla_ilu_osob);
        }
        if ($this->isColumnModified(PrzepisTableMap::COL_OPIS)) {
            $criteria->add(PrzepisTableMap::COL_OPIS, $this->opis);
        }
        if ($this->isColumnModified(PrzepisTableMap::COL_DATA_DODANIA)) {
            $criteria->add(PrzepisTableMap::COL_DATA_DODANIA, $this->data_dodania);
        }
        if ($this->isColumnModified(PrzepisTableMap::COL_STATUS)) {
            $criteria->add(PrzepisTableMap::COL_STATUS, $this->status);
        }
        if ($this->isColumnModified(PrzepisTableMap::COL_ZDJECIE_OGOLNE)) {
            $criteria->add(PrzepisTableMap::COL_ZDJECIE_OGOLNE, $this->zdjecie_ogolne);
        }
        if ($this->isColumnModified(PrzepisTableMap::COL_UZYTKOWNIK_LOGIN)) {
            $criteria->add(PrzepisTableMap::COL_UZYTKOWNIK_LOGIN, $this->uzytkownik_login);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildPrzepisQuery::create();
        $criteria->add(PrzepisTableMap::COL_ID_PRZEPIS, $this->id_przepis);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getIdPrzepis();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getIdPrzepis();
    }

    /**
     * Generic method to set the primary key (id_przepis column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setIdPrzepis($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getIdPrzepis();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Przepis (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setNazwa($this->getNazwa());
        $copyObj->setStopienTrudnosci($this->getStopienTrudnosci());
        $copyObj->setCzasPrzygotowania($this->getCzasPrzygotowania());
        $copyObj->setDlaIluOsob($this->getDlaIluOsob());
        $copyObj->setOpis($this->getOpis());
        $copyObj->setDataDodania($this->getDataDodania());
        $copyObj->setStatus($this->getStatus());
        $copyObj->setZdjecieOgolne($this->getZdjecieOgolne());
        $copyObj->setUzytkownikLogin($this->getUzytkownikLogin());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getEtaps() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEtap($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getUlubiones() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addUlubione($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getLubie_tos() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLubie_to($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getNalezies() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addNalezy($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getZawieras() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addZawiera($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdPrzepis(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \Przepis Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Declares an association between this object and a ChildUzytkownik object.
     *
     * @param  ChildUzytkownik $v
     * @return $this|\Przepis The current object (for fluent API support)
     * @throws PropelException
     */
    public function setUzytkownik(ChildUzytkownik $v = null)
    {
        if ($v === null) {
            $this->setUzytkownikLogin(NULL);
        } else {
            $this->setUzytkownikLogin($v->getLogin());
        }

        $this->aUzytkownik = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildUzytkownik object, it will not be re-added.
        if ($v !== null) {
            $v->addPrzepis($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildUzytkownik object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildUzytkownik The associated ChildUzytkownik object.
     * @throws PropelException
     */
    public function getUzytkownik(ConnectionInterface $con = null)
    {
        if ($this->aUzytkownik === null && (($this->uzytkownik_login !== "" && $this->uzytkownik_login !== null))) {
            $this->aUzytkownik = ChildUzytkownikQuery::create()->findPk($this->uzytkownik_login, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aUzytkownik->addPrzepiss($this);
             */
        }

        return $this->aUzytkownik;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('Etap' === $relationName) {
            $this->initEtaps();
            return;
        }
        if ('Ulubione' === $relationName) {
            $this->initUlubiones();
            return;
        }
        if ('Lubie_to' === $relationName) {
            $this->initLubie_tos();
            return;
        }
        if ('Nalezy' === $relationName) {
            $this->initNalezies();
            return;
        }
        if ('Zawiera' === $relationName) {
            $this->initZawieras();
            return;
        }
    }

    /**
     * Clears out the collEtaps collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addEtaps()
     */
    public function clearEtaps()
    {
        $this->collEtaps = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collEtaps collection loaded partially.
     */
    public function resetPartialEtaps($v = true)
    {
        $this->collEtapsPartial = $v;
    }

    /**
     * Initializes the collEtaps collection.
     *
     * By default this just sets the collEtaps collection to an empty array (like clearcollEtaps());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initEtaps($overrideExisting = true)
    {
        if (null !== $this->collEtaps && !$overrideExisting) {
            return;
        }

        $collectionClassName = EtapTableMap::getTableMap()->getCollectionClassName();

        $this->collEtaps = new $collectionClassName;
        $this->collEtaps->setModel('\Etap');
    }

    /**
     * Gets an array of ChildEtap objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPrzepis is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildEtap[] List of ChildEtap objects
     * @throws PropelException
     */
    public function getEtaps(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collEtapsPartial && !$this->isNew();
        if (null === $this->collEtaps || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collEtaps) {
                    $this->initEtaps();
                } else {
                    $collectionClassName = EtapTableMap::getTableMap()->getCollectionClassName();

                    $collEtaps = new $collectionClassName;
                    $collEtaps->setModel('\Etap');

                    return $collEtaps;
                }
            } else {
                $collEtaps = ChildEtapQuery::create(null, $criteria)
                    ->filterByPrzepis($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collEtapsPartial && count($collEtaps)) {
                        $this->initEtaps(false);

                        foreach ($collEtaps as $obj) {
                            if (false == $this->collEtaps->contains($obj)) {
                                $this->collEtaps->append($obj);
                            }
                        }

                        $this->collEtapsPartial = true;
                    }

                    return $collEtaps;
                }

                if ($partial && $this->collEtaps) {
                    foreach ($this->collEtaps as $obj) {
                        if ($obj->isNew()) {
                            $collEtaps[] = $obj;
                        }
                    }
                }

                $this->collEtaps = $collEtaps;
                $this->collEtapsPartial = false;
            }
        }

        return $this->collEtaps;
    }

    /**
     * Sets a collection of ChildEtap objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $etaps A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildPrzepis The current object (for fluent API support)
     */
    public function setEtaps(Collection $etaps, ConnectionInterface $con = null)
    {
        /** @var ChildEtap[] $etapsToDelete */
        $etapsToDelete = $this->getEtaps(new Criteria(), $con)->diff($etaps);


        $this->etapsScheduledForDeletion = $etapsToDelete;

        foreach ($etapsToDelete as $etapRemoved) {
            $etapRemoved->setPrzepis(null);
        }

        $this->collEtaps = null;
        foreach ($etaps as $etap) {
            $this->addEtap($etap);
        }

        $this->collEtaps = $etaps;
        $this->collEtapsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Etap objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Etap objects.
     * @throws PropelException
     */
    public function countEtaps(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collEtapsPartial && !$this->isNew();
        if (null === $this->collEtaps || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collEtaps) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getEtaps());
            }

            $query = ChildEtapQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPrzepis($this)
                ->count($con);
        }

        return count($this->collEtaps);
    }

    /**
     * Method called to associate a ChildEtap object to this object
     * through the ChildEtap foreign key attribute.
     *
     * @param  ChildEtap $l ChildEtap
     * @return $this|\Przepis The current object (for fluent API support)
     */
    public function addEtap(ChildEtap $l)
    {
        if ($this->collEtaps === null) {
            $this->initEtaps();
            $this->collEtapsPartial = true;
        }

        if (!$this->collEtaps->contains($l)) {
            $this->doAddEtap($l);

            if ($this->etapsScheduledForDeletion and $this->etapsScheduledForDeletion->contains($l)) {
                $this->etapsScheduledForDeletion->remove($this->etapsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildEtap $etap The ChildEtap object to add.
     */
    protected function doAddEtap(ChildEtap $etap)
    {
        $this->collEtaps[]= $etap;
        $etap->setPrzepis($this);
    }

    /**
     * @param  ChildEtap $etap The ChildEtap object to remove.
     * @return $this|ChildPrzepis The current object (for fluent API support)
     */
    public function removeEtap(ChildEtap $etap)
    {
        if ($this->getEtaps()->contains($etap)) {
            $pos = $this->collEtaps->search($etap);
            $this->collEtaps->remove($pos);
            if (null === $this->etapsScheduledForDeletion) {
                $this->etapsScheduledForDeletion = clone $this->collEtaps;
                $this->etapsScheduledForDeletion->clear();
            }
            $this->etapsScheduledForDeletion[]= clone $etap;
            $etap->setPrzepis(null);
        }

        return $this;
    }

    /**
     * Clears out the collUlubiones collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addUlubiones()
     */
    public function clearUlubiones()
    {
        $this->collUlubiones = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collUlubiones collection loaded partially.
     */
    public function resetPartialUlubiones($v = true)
    {
        $this->collUlubionesPartial = $v;
    }

    /**
     * Initializes the collUlubiones collection.
     *
     * By default this just sets the collUlubiones collection to an empty array (like clearcollUlubiones());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initUlubiones($overrideExisting = true)
    {
        if (null !== $this->collUlubiones && !$overrideExisting) {
            return;
        }

        $collectionClassName = UlubioneTableMap::getTableMap()->getCollectionClassName();

        $this->collUlubiones = new $collectionClassName;
        $this->collUlubiones->setModel('\Ulubione');
    }

    /**
     * Gets an array of ChildUlubione objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPrzepis is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildUlubione[] List of ChildUlubione objects
     * @throws PropelException
     */
    public function getUlubiones(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collUlubionesPartial && !$this->isNew();
        if (null === $this->collUlubiones || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collUlubiones) {
                    $this->initUlubiones();
                } else {
                    $collectionClassName = UlubioneTableMap::getTableMap()->getCollectionClassName();

                    $collUlubiones = new $collectionClassName;
                    $collUlubiones->setModel('\Ulubione');

                    return $collUlubiones;
                }
            } else {
                $collUlubiones = ChildUlubioneQuery::create(null, $criteria)
                    ->filterByPrzepis($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collUlubionesPartial && count($collUlubiones)) {
                        $this->initUlubiones(false);

                        foreach ($collUlubiones as $obj) {
                            if (false == $this->collUlubiones->contains($obj)) {
                                $this->collUlubiones->append($obj);
                            }
                        }

                        $this->collUlubionesPartial = true;
                    }

                    return $collUlubiones;
                }

                if ($partial && $this->collUlubiones) {
                    foreach ($this->collUlubiones as $obj) {
                        if ($obj->isNew()) {
                            $collUlubiones[] = $obj;
                        }
                    }
                }

                $this->collUlubiones = $collUlubiones;
                $this->collUlubionesPartial = false;
            }
        }

        return $this->collUlubiones;
    }

    /**
     * Sets a collection of ChildUlubione objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $ulubiones A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildPrzepis The current object (for fluent API support)
     */
    public function setUlubiones(Collection $ulubiones, ConnectionInterface $con = null)
    {
        /** @var ChildUlubione[] $ulubionesToDelete */
        $ulubionesToDelete = $this->getUlubiones(new Criteria(), $con)->diff($ulubiones);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->ulubionesScheduledForDeletion = clone $ulubionesToDelete;

        foreach ($ulubionesToDelete as $ulubioneRemoved) {
            $ulubioneRemoved->setPrzepis(null);
        }

        $this->collUlubiones = null;
        foreach ($ulubiones as $ulubione) {
            $this->addUlubione($ulubione);
        }

        $this->collUlubiones = $ulubiones;
        $this->collUlubionesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Ulubione objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Ulubione objects.
     * @throws PropelException
     */
    public function countUlubiones(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collUlubionesPartial && !$this->isNew();
        if (null === $this->collUlubiones || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collUlubiones) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getUlubiones());
            }

            $query = ChildUlubioneQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPrzepis($this)
                ->count($con);
        }

        return count($this->collUlubiones);
    }

    /**
     * Method called to associate a ChildUlubione object to this object
     * through the ChildUlubione foreign key attribute.
     *
     * @param  ChildUlubione $l ChildUlubione
     * @return $this|\Przepis The current object (for fluent API support)
     */
    public function addUlubione(ChildUlubione $l)
    {
        if ($this->collUlubiones === null) {
            $this->initUlubiones();
            $this->collUlubionesPartial = true;
        }

        if (!$this->collUlubiones->contains($l)) {
            $this->doAddUlubione($l);

            if ($this->ulubionesScheduledForDeletion and $this->ulubionesScheduledForDeletion->contains($l)) {
                $this->ulubionesScheduledForDeletion->remove($this->ulubionesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildUlubione $ulubione The ChildUlubione object to add.
     */
    protected function doAddUlubione(ChildUlubione $ulubione)
    {
        $this->collUlubiones[]= $ulubione;
        $ulubione->setPrzepis($this);
    }

    /**
     * @param  ChildUlubione $ulubione The ChildUlubione object to remove.
     * @return $this|ChildPrzepis The current object (for fluent API support)
     */
    public function removeUlubione(ChildUlubione $ulubione)
    {
        if ($this->getUlubiones()->contains($ulubione)) {
            $pos = $this->collUlubiones->search($ulubione);
            $this->collUlubiones->remove($pos);
            if (null === $this->ulubionesScheduledForDeletion) {
                $this->ulubionesScheduledForDeletion = clone $this->collUlubiones;
                $this->ulubionesScheduledForDeletion->clear();
            }
            $this->ulubionesScheduledForDeletion[]= clone $ulubione;
            $ulubione->setPrzepis(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Przepis is new, it will return
     * an empty collection; or if this Przepis has previously
     * been saved, it will retrieve related Ulubiones from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Przepis.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildUlubione[] List of ChildUlubione objects
     */
    public function getUlubionesJoinUzytkownik(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildUlubioneQuery::create(null, $criteria);
        $query->joinWith('Uzytkownik', $joinBehavior);

        return $this->getUlubiones($query, $con);
    }

    /**
     * Clears out the collLubie_tos collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addLubie_tos()
     */
    public function clearLubie_tos()
    {
        $this->collLubie_tos = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collLubie_tos collection loaded partially.
     */
    public function resetPartialLubie_tos($v = true)
    {
        $this->collLubie_tosPartial = $v;
    }

    /**
     * Initializes the collLubie_tos collection.
     *
     * By default this just sets the collLubie_tos collection to an empty array (like clearcollLubie_tos());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initLubie_tos($overrideExisting = true)
    {
        if (null !== $this->collLubie_tos && !$overrideExisting) {
            return;
        }

        $collectionClassName = Lubie_toTableMap::getTableMap()->getCollectionClassName();

        $this->collLubie_tos = new $collectionClassName;
        $this->collLubie_tos->setModel('\Lubie_to');
    }

    /**
     * Gets an array of ChildLubie_to objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPrzepis is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildLubie_to[] List of ChildLubie_to objects
     * @throws PropelException
     */
    public function getLubie_tos(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collLubie_tosPartial && !$this->isNew();
        if (null === $this->collLubie_tos || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collLubie_tos) {
                    $this->initLubie_tos();
                } else {
                    $collectionClassName = Lubie_toTableMap::getTableMap()->getCollectionClassName();

                    $collLubie_tos = new $collectionClassName;
                    $collLubie_tos->setModel('\Lubie_to');

                    return $collLubie_tos;
                }
            } else {
                $collLubie_tos = ChildLubie_toQuery::create(null, $criteria)
                    ->filterByPrzepis($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collLubie_tosPartial && count($collLubie_tos)) {
                        $this->initLubie_tos(false);

                        foreach ($collLubie_tos as $obj) {
                            if (false == $this->collLubie_tos->contains($obj)) {
                                $this->collLubie_tos->append($obj);
                            }
                        }

                        $this->collLubie_tosPartial = true;
                    }

                    return $collLubie_tos;
                }

                if ($partial && $this->collLubie_tos) {
                    foreach ($this->collLubie_tos as $obj) {
                        if ($obj->isNew()) {
                            $collLubie_tos[] = $obj;
                        }
                    }
                }

                $this->collLubie_tos = $collLubie_tos;
                $this->collLubie_tosPartial = false;
            }
        }

        return $this->collLubie_tos;
    }

    /**
     * Sets a collection of ChildLubie_to objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $lubie_tos A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildPrzepis The current object (for fluent API support)
     */
    public function setLubie_tos(Collection $lubie_tos, ConnectionInterface $con = null)
    {
        /** @var ChildLubie_to[] $lubie_tosToDelete */
        $lubie_tosToDelete = $this->getLubie_tos(new Criteria(), $con)->diff($lubie_tos);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->lubie_tosScheduledForDeletion = clone $lubie_tosToDelete;

        foreach ($lubie_tosToDelete as $lubie_toRemoved) {
            $lubie_toRemoved->setPrzepis(null);
        }

        $this->collLubie_tos = null;
        foreach ($lubie_tos as $lubie_to) {
            $this->addLubie_to($lubie_to);
        }

        $this->collLubie_tos = $lubie_tos;
        $this->collLubie_tosPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Lubie_to objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Lubie_to objects.
     * @throws PropelException
     */
    public function countLubie_tos(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collLubie_tosPartial && !$this->isNew();
        if (null === $this->collLubie_tos || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collLubie_tos) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getLubie_tos());
            }

            $query = ChildLubie_toQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPrzepis($this)
                ->count($con);
        }

        return count($this->collLubie_tos);
    }

    /**
     * Method called to associate a ChildLubie_to object to this object
     * through the ChildLubie_to foreign key attribute.
     *
     * @param  ChildLubie_to $l ChildLubie_to
     * @return $this|\Przepis The current object (for fluent API support)
     */
    public function addLubie_to(ChildLubie_to $l)
    {
        if ($this->collLubie_tos === null) {
            $this->initLubie_tos();
            $this->collLubie_tosPartial = true;
        }

        if (!$this->collLubie_tos->contains($l)) {
            $this->doAddLubie_to($l);

            if ($this->lubie_tosScheduledForDeletion and $this->lubie_tosScheduledForDeletion->contains($l)) {
                $this->lubie_tosScheduledForDeletion->remove($this->lubie_tosScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildLubie_to $lubie_to The ChildLubie_to object to add.
     */
    protected function doAddLubie_to(ChildLubie_to $lubie_to)
    {
        $this->collLubie_tos[]= $lubie_to;
        $lubie_to->setPrzepis($this);
    }

    /**
     * @param  ChildLubie_to $lubie_to The ChildLubie_to object to remove.
     * @return $this|ChildPrzepis The current object (for fluent API support)
     */
    public function removeLubie_to(ChildLubie_to $lubie_to)
    {
        if ($this->getLubie_tos()->contains($lubie_to)) {
            $pos = $this->collLubie_tos->search($lubie_to);
            $this->collLubie_tos->remove($pos);
            if (null === $this->lubie_tosScheduledForDeletion) {
                $this->lubie_tosScheduledForDeletion = clone $this->collLubie_tos;
                $this->lubie_tosScheduledForDeletion->clear();
            }
            $this->lubie_tosScheduledForDeletion[]= clone $lubie_to;
            $lubie_to->setPrzepis(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Przepis is new, it will return
     * an empty collection; or if this Przepis has previously
     * been saved, it will retrieve related Lubie_tos from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Przepis.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildLubie_to[] List of ChildLubie_to objects
     */
    public function getLubie_tosJoinUzytkownik(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildLubie_toQuery::create(null, $criteria);
        $query->joinWith('Uzytkownik', $joinBehavior);

        return $this->getLubie_tos($query, $con);
    }

    /**
     * Clears out the collNalezies collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addNalezies()
     */
    public function clearNalezies()
    {
        $this->collNalezies = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collNalezies collection loaded partially.
     */
    public function resetPartialNalezies($v = true)
    {
        $this->collNaleziesPartial = $v;
    }

    /**
     * Initializes the collNalezies collection.
     *
     * By default this just sets the collNalezies collection to an empty array (like clearcollNalezies());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initNalezies($overrideExisting = true)
    {
        if (null !== $this->collNalezies && !$overrideExisting) {
            return;
        }

        $collectionClassName = NalezyTableMap::getTableMap()->getCollectionClassName();

        $this->collNalezies = new $collectionClassName;
        $this->collNalezies->setModel('\Nalezy');
    }

    /**
     * Gets an array of ChildNalezy objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPrzepis is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildNalezy[] List of ChildNalezy objects
     * @throws PropelException
     */
    public function getNalezies(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collNaleziesPartial && !$this->isNew();
        if (null === $this->collNalezies || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collNalezies) {
                    $this->initNalezies();
                } else {
                    $collectionClassName = NalezyTableMap::getTableMap()->getCollectionClassName();

                    $collNalezies = new $collectionClassName;
                    $collNalezies->setModel('\Nalezy');

                    return $collNalezies;
                }
            } else {
                $collNalezies = ChildNalezyQuery::create(null, $criteria)
                    ->filterByPrzepis($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collNaleziesPartial && count($collNalezies)) {
                        $this->initNalezies(false);

                        foreach ($collNalezies as $obj) {
                            if (false == $this->collNalezies->contains($obj)) {
                                $this->collNalezies->append($obj);
                            }
                        }

                        $this->collNaleziesPartial = true;
                    }

                    return $collNalezies;
                }

                if ($partial && $this->collNalezies) {
                    foreach ($this->collNalezies as $obj) {
                        if ($obj->isNew()) {
                            $collNalezies[] = $obj;
                        }
                    }
                }

                $this->collNalezies = $collNalezies;
                $this->collNaleziesPartial = false;
            }
        }

        return $this->collNalezies;
    }

    /**
     * Sets a collection of ChildNalezy objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $nalezies A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildPrzepis The current object (for fluent API support)
     */
    public function setNalezies(Collection $nalezies, ConnectionInterface $con = null)
    {
        /** @var ChildNalezy[] $naleziesToDelete */
        $naleziesToDelete = $this->getNalezies(new Criteria(), $con)->diff($nalezies);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->naleziesScheduledForDeletion = clone $naleziesToDelete;

        foreach ($naleziesToDelete as $nalezyRemoved) {
            $nalezyRemoved->setPrzepis(null);
        }

        $this->collNalezies = null;
        foreach ($nalezies as $nalezy) {
            $this->addNalezy($nalezy);
        }

        $this->collNalezies = $nalezies;
        $this->collNaleziesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Nalezy objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Nalezy objects.
     * @throws PropelException
     */
    public function countNalezies(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collNaleziesPartial && !$this->isNew();
        if (null === $this->collNalezies || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collNalezies) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getNalezies());
            }

            $query = ChildNalezyQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPrzepis($this)
                ->count($con);
        }

        return count($this->collNalezies);
    }

    /**
     * Method called to associate a ChildNalezy object to this object
     * through the ChildNalezy foreign key attribute.
     *
     * @param  ChildNalezy $l ChildNalezy
     * @return $this|\Przepis The current object (for fluent API support)
     */
    public function addNalezy(ChildNalezy $l)
    {
        if ($this->collNalezies === null) {
            $this->initNalezies();
            $this->collNaleziesPartial = true;
        }

        if (!$this->collNalezies->contains($l)) {
            $this->doAddNalezy($l);

            if ($this->naleziesScheduledForDeletion and $this->naleziesScheduledForDeletion->contains($l)) {
                $this->naleziesScheduledForDeletion->remove($this->naleziesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildNalezy $nalezy The ChildNalezy object to add.
     */
    protected function doAddNalezy(ChildNalezy $nalezy)
    {
        $this->collNalezies[]= $nalezy;
        $nalezy->setPrzepis($this);
    }

    /**
     * @param  ChildNalezy $nalezy The ChildNalezy object to remove.
     * @return $this|ChildPrzepis The current object (for fluent API support)
     */
    public function removeNalezy(ChildNalezy $nalezy)
    {
        if ($this->getNalezies()->contains($nalezy)) {
            $pos = $this->collNalezies->search($nalezy);
            $this->collNalezies->remove($pos);
            if (null === $this->naleziesScheduledForDeletion) {
                $this->naleziesScheduledForDeletion = clone $this->collNalezies;
                $this->naleziesScheduledForDeletion->clear();
            }
            $this->naleziesScheduledForDeletion[]= clone $nalezy;
            $nalezy->setPrzepis(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Przepis is new, it will return
     * an empty collection; or if this Przepis has previously
     * been saved, it will retrieve related Nalezies from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Przepis.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildNalezy[] List of ChildNalezy objects
     */
    public function getNaleziesJoinKategoria(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildNalezyQuery::create(null, $criteria);
        $query->joinWith('Kategoria', $joinBehavior);

        return $this->getNalezies($query, $con);
    }

    /**
     * Clears out the collZawieras collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addZawieras()
     */
    public function clearZawieras()
    {
        $this->collZawieras = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collZawieras collection loaded partially.
     */
    public function resetPartialZawieras($v = true)
    {
        $this->collZawierasPartial = $v;
    }

    /**
     * Initializes the collZawieras collection.
     *
     * By default this just sets the collZawieras collection to an empty array (like clearcollZawieras());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initZawieras($overrideExisting = true)
    {
        if (null !== $this->collZawieras && !$overrideExisting) {
            return;
        }

        $collectionClassName = ZawieraTableMap::getTableMap()->getCollectionClassName();

        $this->collZawieras = new $collectionClassName;
        $this->collZawieras->setModel('\Zawiera');
    }

    /**
     * Gets an array of ChildZawiera objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPrzepis is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildZawiera[] List of ChildZawiera objects
     * @throws PropelException
     */
    public function getZawieras(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collZawierasPartial && !$this->isNew();
        if (null === $this->collZawieras || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collZawieras) {
                    $this->initZawieras();
                } else {
                    $collectionClassName = ZawieraTableMap::getTableMap()->getCollectionClassName();

                    $collZawieras = new $collectionClassName;
                    $collZawieras->setModel('\Zawiera');

                    return $collZawieras;
                }
            } else {
                $collZawieras = ChildZawieraQuery::create(null, $criteria)
                    ->filterByPrzepis($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collZawierasPartial && count($collZawieras)) {
                        $this->initZawieras(false);

                        foreach ($collZawieras as $obj) {
                            if (false == $this->collZawieras->contains($obj)) {
                                $this->collZawieras->append($obj);
                            }
                        }

                        $this->collZawierasPartial = true;
                    }

                    return $collZawieras;
                }

                if ($partial && $this->collZawieras) {
                    foreach ($this->collZawieras as $obj) {
                        if ($obj->isNew()) {
                            $collZawieras[] = $obj;
                        }
                    }
                }

                $this->collZawieras = $collZawieras;
                $this->collZawierasPartial = false;
            }
        }

        return $this->collZawieras;
    }

    /**
     * Sets a collection of ChildZawiera objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $zawieras A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildPrzepis The current object (for fluent API support)
     */
    public function setZawieras(Collection $zawieras, ConnectionInterface $con = null)
    {
        /** @var ChildZawiera[] $zawierasToDelete */
        $zawierasToDelete = $this->getZawieras(new Criteria(), $con)->diff($zawieras);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->zawierasScheduledForDeletion = clone $zawierasToDelete;

        foreach ($zawierasToDelete as $zawieraRemoved) {
            $zawieraRemoved->setPrzepis(null);
        }

        $this->collZawieras = null;
        foreach ($zawieras as $zawiera) {
            $this->addZawiera($zawiera);
        }

        $this->collZawieras = $zawieras;
        $this->collZawierasPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Zawiera objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Zawiera objects.
     * @throws PropelException
     */
    public function countZawieras(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collZawierasPartial && !$this->isNew();
        if (null === $this->collZawieras || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collZawieras) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getZawieras());
            }

            $query = ChildZawieraQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPrzepis($this)
                ->count($con);
        }

        return count($this->collZawieras);
    }

    /**
     * Method called to associate a ChildZawiera object to this object
     * through the ChildZawiera foreign key attribute.
     *
     * @param  ChildZawiera $l ChildZawiera
     * @return $this|\Przepis The current object (for fluent API support)
     */
    public function addZawiera(ChildZawiera $l)
    {
        if ($this->collZawieras === null) {
            $this->initZawieras();
            $this->collZawierasPartial = true;
        }

        if (!$this->collZawieras->contains($l)) {
            $this->doAddZawiera($l);

            if ($this->zawierasScheduledForDeletion and $this->zawierasScheduledForDeletion->contains($l)) {
                $this->zawierasScheduledForDeletion->remove($this->zawierasScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildZawiera $zawiera The ChildZawiera object to add.
     */
    protected function doAddZawiera(ChildZawiera $zawiera)
    {
        $this->collZawieras[]= $zawiera;
        $zawiera->setPrzepis($this);
    }

    /**
     * @param  ChildZawiera $zawiera The ChildZawiera object to remove.
     * @return $this|ChildPrzepis The current object (for fluent API support)
     */
    public function removeZawiera(ChildZawiera $zawiera)
    {
        if ($this->getZawieras()->contains($zawiera)) {
            $pos = $this->collZawieras->search($zawiera);
            $this->collZawieras->remove($pos);
            if (null === $this->zawierasScheduledForDeletion) {
                $this->zawierasScheduledForDeletion = clone $this->collZawieras;
                $this->zawierasScheduledForDeletion->clear();
            }
            $this->zawierasScheduledForDeletion[]= clone $zawiera;
            $zawiera->setPrzepis(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Przepis is new, it will return
     * an empty collection; or if this Przepis has previously
     * been saved, it will retrieve related Zawieras from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Przepis.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildZawiera[] List of ChildZawiera objects
     */
    public function getZawierasJoinSkladniki(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildZawieraQuery::create(null, $criteria);
        $query->joinWith('Skladniki', $joinBehavior);

        return $this->getZawieras($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aUzytkownik) {
            $this->aUzytkownik->removePrzepis($this);
        }
        $this->id_przepis = null;
        $this->nazwa = null;
        $this->stopien_trudnosci = null;
        $this->czas_przygotowania = null;
        $this->dla_ilu_osob = null;
        $this->opis = null;
        $this->data_dodania = null;
        $this->status = null;
        $this->zdjecie_ogolne = null;
        $this->uzytkownik_login = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
            if ($this->collEtaps) {
                foreach ($this->collEtaps as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collUlubiones) {
                foreach ($this->collUlubiones as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collLubie_tos) {
                foreach ($this->collLubie_tos as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collNalezies) {
                foreach ($this->collNalezies as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collZawieras) {
                foreach ($this->collZawieras as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collEtaps = null;
        $this->collUlubiones = null;
        $this->collLubie_tos = null;
        $this->collNalezies = null;
        $this->collZawieras = null;
        $this->aUzytkownik = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(PrzepisTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
                return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {
            }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
                return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {
            }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
                return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {
            }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
                return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {
            }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);
            $inputData = $params[0];
            $keyType = $params[1] ?? TableMap::TYPE_PHPNAME;

            return $this->importFrom($format, $inputData, $keyType);
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = $params[0] ?? true;
            $keyType = $params[1] ?? TableMap::TYPE_PHPNAME;

            return $this->exportTo($format, $includeLazyLoadColumns, $keyType);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
