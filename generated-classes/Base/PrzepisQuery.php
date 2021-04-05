<?php

namespace Base;

use \Przepis as ChildPrzepis;
use \PrzepisQuery as ChildPrzepisQuery;
use \Exception;
use \PDO;
use Map\PrzepisTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'przepis' table.
 *
 *
 *
 * @method     ChildPrzepisQuery orderByIdPrzepis($order = Criteria::ASC) Order by the id_przepis column
 * @method     ChildPrzepisQuery orderByNazwa($order = Criteria::ASC) Order by the nazwa column
 * @method     ChildPrzepisQuery orderByStopienTrudnosci($order = Criteria::ASC) Order by the stopien_trudnosci column
 * @method     ChildPrzepisQuery orderByCzasPrzygotowania($order = Criteria::ASC) Order by the czas_przygotowania column
 * @method     ChildPrzepisQuery orderByDlaIluOsob($order = Criteria::ASC) Order by the dla_ilu_osob column
 * @method     ChildPrzepisQuery orderByOpis($order = Criteria::ASC) Order by the opis column
 * @method     ChildPrzepisQuery orderByDataDodania($order = Criteria::ASC) Order by the data_dodania column
 * @method     ChildPrzepisQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildPrzepisQuery orderByZdjecieOgolne($order = Criteria::ASC) Order by the zdjecie_ogolne column
 * @method     ChildPrzepisQuery orderByUzytkownikLogin($order = Criteria::ASC) Order by the UZYTKOWNIK_login column
 *
 * @method     ChildPrzepisQuery groupByIdPrzepis() Group by the id_przepis column
 * @method     ChildPrzepisQuery groupByNazwa() Group by the nazwa column
 * @method     ChildPrzepisQuery groupByStopienTrudnosci() Group by the stopien_trudnosci column
 * @method     ChildPrzepisQuery groupByCzasPrzygotowania() Group by the czas_przygotowania column
 * @method     ChildPrzepisQuery groupByDlaIluOsob() Group by the dla_ilu_osob column
 * @method     ChildPrzepisQuery groupByOpis() Group by the opis column
 * @method     ChildPrzepisQuery groupByDataDodania() Group by the data_dodania column
 * @method     ChildPrzepisQuery groupByStatus() Group by the status column
 * @method     ChildPrzepisQuery groupByZdjecieOgolne() Group by the zdjecie_ogolne column
 * @method     ChildPrzepisQuery groupByUzytkownikLogin() Group by the UZYTKOWNIK_login column
 *
 * @method     ChildPrzepisQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPrzepisQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPrzepisQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPrzepisQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPrzepisQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPrzepisQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPrzepisQuery leftJoinUzytkownik($relationAlias = null) Adds a LEFT JOIN clause to the query using the Uzytkownik relation
 * @method     ChildPrzepisQuery rightJoinUzytkownik($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Uzytkownik relation
 * @method     ChildPrzepisQuery innerJoinUzytkownik($relationAlias = null) Adds a INNER JOIN clause to the query using the Uzytkownik relation
 *
 * @method     ChildPrzepisQuery joinWithUzytkownik($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Uzytkownik relation
 *
 * @method     ChildPrzepisQuery leftJoinWithUzytkownik() Adds a LEFT JOIN clause and with to the query using the Uzytkownik relation
 * @method     ChildPrzepisQuery rightJoinWithUzytkownik() Adds a RIGHT JOIN clause and with to the query using the Uzytkownik relation
 * @method     ChildPrzepisQuery innerJoinWithUzytkownik() Adds a INNER JOIN clause and with to the query using the Uzytkownik relation
 *
 * @method     ChildPrzepisQuery leftJoinPRZEPIS_id_przepis($relationAlias = null) Adds a LEFT JOIN clause to the query using the PRZEPIS_id_przepis relation
 * @method     ChildPrzepisQuery rightJoinPRZEPIS_id_przepis($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PRZEPIS_id_przepis relation
 * @method     ChildPrzepisQuery innerJoinPRZEPIS_id_przepis($relationAlias = null) Adds a INNER JOIN clause to the query using the PRZEPIS_id_przepis relation
 *
 * @method     ChildPrzepisQuery joinWithPRZEPIS_id_przepis($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PRZEPIS_id_przepis relation
 *
 * @method     ChildPrzepisQuery leftJoinWithPRZEPIS_id_przepis() Adds a LEFT JOIN clause and with to the query using the PRZEPIS_id_przepis relation
 * @method     ChildPrzepisQuery rightJoinWithPRZEPIS_id_przepis() Adds a RIGHT JOIN clause and with to the query using the PRZEPIS_id_przepis relation
 * @method     ChildPrzepisQuery innerJoinWithPRZEPIS_id_przepis() Adds a INNER JOIN clause and with to the query using the PRZEPIS_id_przepis relation
 *
 * @method     ChildPrzepisQuery leftJoinPRZEPIS_id_przepis($relationAlias = null) Adds a LEFT JOIN clause to the query using the PRZEPIS_id_przepis relation
 * @method     ChildPrzepisQuery rightJoinPRZEPIS_id_przepis($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PRZEPIS_id_przepis relation
 * @method     ChildPrzepisQuery innerJoinPRZEPIS_id_przepis($relationAlias = null) Adds a INNER JOIN clause to the query using the PRZEPIS_id_przepis relation
 *
 * @method     ChildPrzepisQuery joinWithPRZEPIS_id_przepis($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PRZEPIS_id_przepis relation
 *
 * @method     ChildPrzepisQuery leftJoinWithPRZEPIS_id_przepis() Adds a LEFT JOIN clause and with to the query using the PRZEPIS_id_przepis relation
 * @method     ChildPrzepisQuery rightJoinWithPRZEPIS_id_przepis() Adds a RIGHT JOIN clause and with to the query using the PRZEPIS_id_przepis relation
 * @method     ChildPrzepisQuery innerJoinWithPRZEPIS_id_przepis() Adds a INNER JOIN clause and with to the query using the PRZEPIS_id_przepis relation
 *
 * @method     ChildPrzepisQuery leftJoinPRZEPIS_id_przepis($relationAlias = null) Adds a LEFT JOIN clause to the query using the PRZEPIS_id_przepis relation
 * @method     ChildPrzepisQuery rightJoinPRZEPIS_id_przepis($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PRZEPIS_id_przepis relation
 * @method     ChildPrzepisQuery innerJoinPRZEPIS_id_przepis($relationAlias = null) Adds a INNER JOIN clause to the query using the PRZEPIS_id_przepis relation
 *
 * @method     ChildPrzepisQuery joinWithPRZEPIS_id_przepis($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PRZEPIS_id_przepis relation
 *
 * @method     ChildPrzepisQuery leftJoinWithPRZEPIS_id_przepis() Adds a LEFT JOIN clause and with to the query using the PRZEPIS_id_przepis relation
 * @method     ChildPrzepisQuery rightJoinWithPRZEPIS_id_przepis() Adds a RIGHT JOIN clause and with to the query using the PRZEPIS_id_przepis relation
 * @method     ChildPrzepisQuery innerJoinWithPRZEPIS_id_przepis() Adds a INNER JOIN clause and with to the query using the PRZEPIS_id_przepis relation
 *
 * @method     ChildPrzepisQuery leftJoinPRZEPIS_id_przepis($relationAlias = null) Adds a LEFT JOIN clause to the query using the PRZEPIS_id_przepis relation
 * @method     ChildPrzepisQuery rightJoinPRZEPIS_id_przepis($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PRZEPIS_id_przepis relation
 * @method     ChildPrzepisQuery innerJoinPRZEPIS_id_przepis($relationAlias = null) Adds a INNER JOIN clause to the query using the PRZEPIS_id_przepis relation
 *
 * @method     ChildPrzepisQuery joinWithPRZEPIS_id_przepis($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PRZEPIS_id_przepis relation
 *
 * @method     ChildPrzepisQuery leftJoinWithPRZEPIS_id_przepis() Adds a LEFT JOIN clause and with to the query using the PRZEPIS_id_przepis relation
 * @method     ChildPrzepisQuery rightJoinWithPRZEPIS_id_przepis() Adds a RIGHT JOIN clause and with to the query using the PRZEPIS_id_przepis relation
 * @method     ChildPrzepisQuery innerJoinWithPRZEPIS_id_przepis() Adds a INNER JOIN clause and with to the query using the PRZEPIS_id_przepis relation
 *
 * @method     ChildPrzepisQuery leftJoinPRZEPIS_id_przepis($relationAlias = null) Adds a LEFT JOIN clause to the query using the PRZEPIS_id_przepis relation
 * @method     ChildPrzepisQuery rightJoinPRZEPIS_id_przepis($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PRZEPIS_id_przepis relation
 * @method     ChildPrzepisQuery innerJoinPRZEPIS_id_przepis($relationAlias = null) Adds a INNER JOIN clause to the query using the PRZEPIS_id_przepis relation
 *
 * @method     ChildPrzepisQuery joinWithPRZEPIS_id_przepis($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PRZEPIS_id_przepis relation
 *
 * @method     ChildPrzepisQuery leftJoinWithPRZEPIS_id_przepis() Adds a LEFT JOIN clause and with to the query using the PRZEPIS_id_przepis relation
 * @method     ChildPrzepisQuery rightJoinWithPRZEPIS_id_przepis() Adds a RIGHT JOIN clause and with to the query using the PRZEPIS_id_przepis relation
 * @method     ChildPrzepisQuery innerJoinWithPRZEPIS_id_przepis() Adds a INNER JOIN clause and with to the query using the PRZEPIS_id_przepis relation
 *
 * @method     \UzytkownikQuery|\EtapQuery|\UlubioneQuery|\Lubie_toQuery|\NalezyQuery|\ZawieraQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPrzepis|null findOne(ConnectionInterface $con = null) Return the first ChildPrzepis matching the query
 * @method     ChildPrzepis findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPrzepis matching the query, or a new ChildPrzepis object populated from the query conditions when no match is found
 *
 * @method     ChildPrzepis|null findOneByIdPrzepis(int $id_przepis) Return the first ChildPrzepis filtered by the id_przepis column
 * @method     ChildPrzepis|null findOneByNazwa(string $nazwa) Return the first ChildPrzepis filtered by the nazwa column
 * @method     ChildPrzepis|null findOneByStopienTrudnosci(int $stopien_trudnosci) Return the first ChildPrzepis filtered by the stopien_trudnosci column
 * @method     ChildPrzepis|null findOneByCzasPrzygotowania(int $czas_przygotowania) Return the first ChildPrzepis filtered by the czas_przygotowania column
 * @method     ChildPrzepis|null findOneByDlaIluOsob(int $dla_ilu_osob) Return the first ChildPrzepis filtered by the dla_ilu_osob column
 * @method     ChildPrzepis|null findOneByOpis(string $opis) Return the first ChildPrzepis filtered by the opis column
 * @method     ChildPrzepis|null findOneByDataDodania(string $data_dodania) Return the first ChildPrzepis filtered by the data_dodania column
 * @method     ChildPrzepis|null findOneByStatus(int $status) Return the first ChildPrzepis filtered by the status column
 * @method     ChildPrzepis|null findOneByZdjecieOgolne(resource $zdjecie_ogolne) Return the first ChildPrzepis filtered by the zdjecie_ogolne column
 * @method     ChildPrzepis|null findOneByUzytkownikLogin(string $UZYTKOWNIK_login) Return the first ChildPrzepis filtered by the UZYTKOWNIK_login column *

 * @method     ChildPrzepis requirePk($key, ConnectionInterface $con = null) Return the ChildPrzepis by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPrzepis requireOne(ConnectionInterface $con = null) Return the first ChildPrzepis matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPrzepis requireOneByIdPrzepis(int $id_przepis) Return the first ChildPrzepis filtered by the id_przepis column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPrzepis requireOneByNazwa(string $nazwa) Return the first ChildPrzepis filtered by the nazwa column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPrzepis requireOneByStopienTrudnosci(int $stopien_trudnosci) Return the first ChildPrzepis filtered by the stopien_trudnosci column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPrzepis requireOneByCzasPrzygotowania(int $czas_przygotowania) Return the first ChildPrzepis filtered by the czas_przygotowania column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPrzepis requireOneByDlaIluOsob(int $dla_ilu_osob) Return the first ChildPrzepis filtered by the dla_ilu_osob column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPrzepis requireOneByOpis(string $opis) Return the first ChildPrzepis filtered by the opis column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPrzepis requireOneByDataDodania(string $data_dodania) Return the first ChildPrzepis filtered by the data_dodania column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPrzepis requireOneByStatus(int $status) Return the first ChildPrzepis filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPrzepis requireOneByZdjecieOgolne(resource $zdjecie_ogolne) Return the first ChildPrzepis filtered by the zdjecie_ogolne column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPrzepis requireOneByUzytkownikLogin(string $UZYTKOWNIK_login) Return the first ChildPrzepis filtered by the UZYTKOWNIK_login column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPrzepis[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPrzepis objects based on current ModelCriteria
 * @method     ChildPrzepis[]|ObjectCollection findByIdPrzepis(int $id_przepis) Return ChildPrzepis objects filtered by the id_przepis column
 * @method     ChildPrzepis[]|ObjectCollection findByNazwa(string $nazwa) Return ChildPrzepis objects filtered by the nazwa column
 * @method     ChildPrzepis[]|ObjectCollection findByStopienTrudnosci(int $stopien_trudnosci) Return ChildPrzepis objects filtered by the stopien_trudnosci column
 * @method     ChildPrzepis[]|ObjectCollection findByCzasPrzygotowania(int $czas_przygotowania) Return ChildPrzepis objects filtered by the czas_przygotowania column
 * @method     ChildPrzepis[]|ObjectCollection findByDlaIluOsob(int $dla_ilu_osob) Return ChildPrzepis objects filtered by the dla_ilu_osob column
 * @method     ChildPrzepis[]|ObjectCollection findByOpis(string $opis) Return ChildPrzepis objects filtered by the opis column
 * @method     ChildPrzepis[]|ObjectCollection findByDataDodania(string $data_dodania) Return ChildPrzepis objects filtered by the data_dodania column
 * @method     ChildPrzepis[]|ObjectCollection findByStatus(int $status) Return ChildPrzepis objects filtered by the status column
 * @method     ChildPrzepis[]|ObjectCollection findByZdjecieOgolne(resource $zdjecie_ogolne) Return ChildPrzepis objects filtered by the zdjecie_ogolne column
 * @method     ChildPrzepis[]|ObjectCollection findByUzytkownikLogin(string $UZYTKOWNIK_login) Return ChildPrzepis objects filtered by the UZYTKOWNIK_login column
 * @method     ChildPrzepis[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PrzepisQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\PrzepisQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'kulinaria', $modelName = '\\Przepis', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPrzepisQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPrzepisQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPrzepisQuery) {
            return $criteria;
        }
        $query = new ChildPrzepisQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildPrzepis|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PrzepisTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = PrzepisTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPrzepis A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_przepis, nazwa, stopien_trudnosci, czas_przygotowania, dla_ilu_osob, opis, data_dodania, status, zdjecie_ogolne, UZYTKOWNIK_login FROM przepis WHERE id_przepis = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildPrzepis $obj */
            $obj = new ChildPrzepis();
            $obj->hydrate($row);
            PrzepisTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildPrzepis|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildPrzepisQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PrzepisTableMap::COL_ID_PRZEPIS, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPrzepisQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PrzepisTableMap::COL_ID_PRZEPIS, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id_przepis column
     *
     * Example usage:
     * <code>
     * $query->filterByIdPrzepis(1234); // WHERE id_przepis = 1234
     * $query->filterByIdPrzepis(array(12, 34)); // WHERE id_przepis IN (12, 34)
     * $query->filterByIdPrzepis(array('min' => 12)); // WHERE id_przepis > 12
     * </code>
     *
     * @param     mixed $idPrzepis The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPrzepisQuery The current query, for fluid interface
     */
    public function filterByIdPrzepis($idPrzepis = null, $comparison = null)
    {
        if (is_array($idPrzepis)) {
            $useMinMax = false;
            if (isset($idPrzepis['min'])) {
                $this->addUsingAlias(PrzepisTableMap::COL_ID_PRZEPIS, $idPrzepis['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idPrzepis['max'])) {
                $this->addUsingAlias(PrzepisTableMap::COL_ID_PRZEPIS, $idPrzepis['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PrzepisTableMap::COL_ID_PRZEPIS, $idPrzepis, $comparison);
    }

    /**
     * Filter the query on the nazwa column
     *
     * Example usage:
     * <code>
     * $query->filterByNazwa('fooValue');   // WHERE nazwa = 'fooValue'
     * $query->filterByNazwa('%fooValue%', Criteria::LIKE); // WHERE nazwa LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nazwa The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPrzepisQuery The current query, for fluid interface
     */
    public function filterByNazwa($nazwa = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nazwa)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PrzepisTableMap::COL_NAZWA, $nazwa, $comparison);
    }

    /**
     * Filter the query on the stopien_trudnosci column
     *
     * Example usage:
     * <code>
     * $query->filterByStopienTrudnosci(1234); // WHERE stopien_trudnosci = 1234
     * $query->filterByStopienTrudnosci(array(12, 34)); // WHERE stopien_trudnosci IN (12, 34)
     * $query->filterByStopienTrudnosci(array('min' => 12)); // WHERE stopien_trudnosci > 12
     * </code>
     *
     * @param     mixed $stopienTrudnosci The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPrzepisQuery The current query, for fluid interface
     */
    public function filterByStopienTrudnosci($stopienTrudnosci = null, $comparison = null)
    {
        if (is_array($stopienTrudnosci)) {
            $useMinMax = false;
            if (isset($stopienTrudnosci['min'])) {
                $this->addUsingAlias(PrzepisTableMap::COL_STOPIEN_TRUDNOSCI, $stopienTrudnosci['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($stopienTrudnosci['max'])) {
                $this->addUsingAlias(PrzepisTableMap::COL_STOPIEN_TRUDNOSCI, $stopienTrudnosci['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PrzepisTableMap::COL_STOPIEN_TRUDNOSCI, $stopienTrudnosci, $comparison);
    }

    /**
     * Filter the query on the czas_przygotowania column
     *
     * Example usage:
     * <code>
     * $query->filterByCzasPrzygotowania(1234); // WHERE czas_przygotowania = 1234
     * $query->filterByCzasPrzygotowania(array(12, 34)); // WHERE czas_przygotowania IN (12, 34)
     * $query->filterByCzasPrzygotowania(array('min' => 12)); // WHERE czas_przygotowania > 12
     * </code>
     *
     * @param     mixed $czasPrzygotowania The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPrzepisQuery The current query, for fluid interface
     */
    public function filterByCzasPrzygotowania($czasPrzygotowania = null, $comparison = null)
    {
        if (is_array($czasPrzygotowania)) {
            $useMinMax = false;
            if (isset($czasPrzygotowania['min'])) {
                $this->addUsingAlias(PrzepisTableMap::COL_CZAS_PRZYGOTOWANIA, $czasPrzygotowania['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($czasPrzygotowania['max'])) {
                $this->addUsingAlias(PrzepisTableMap::COL_CZAS_PRZYGOTOWANIA, $czasPrzygotowania['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PrzepisTableMap::COL_CZAS_PRZYGOTOWANIA, $czasPrzygotowania, $comparison);
    }

    /**
     * Filter the query on the dla_ilu_osob column
     *
     * Example usage:
     * <code>
     * $query->filterByDlaIluOsob(1234); // WHERE dla_ilu_osob = 1234
     * $query->filterByDlaIluOsob(array(12, 34)); // WHERE dla_ilu_osob IN (12, 34)
     * $query->filterByDlaIluOsob(array('min' => 12)); // WHERE dla_ilu_osob > 12
     * </code>
     *
     * @param     mixed $dlaIluOsob The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPrzepisQuery The current query, for fluid interface
     */
    public function filterByDlaIluOsob($dlaIluOsob = null, $comparison = null)
    {
        if (is_array($dlaIluOsob)) {
            $useMinMax = false;
            if (isset($dlaIluOsob['min'])) {
                $this->addUsingAlias(PrzepisTableMap::COL_DLA_ILU_OSOB, $dlaIluOsob['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dlaIluOsob['max'])) {
                $this->addUsingAlias(PrzepisTableMap::COL_DLA_ILU_OSOB, $dlaIluOsob['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PrzepisTableMap::COL_DLA_ILU_OSOB, $dlaIluOsob, $comparison);
    }

    /**
     * Filter the query on the opis column
     *
     * Example usage:
     * <code>
     * $query->filterByOpis('fooValue');   // WHERE opis = 'fooValue'
     * $query->filterByOpis('%fooValue%', Criteria::LIKE); // WHERE opis LIKE '%fooValue%'
     * </code>
     *
     * @param     string $opis The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPrzepisQuery The current query, for fluid interface
     */
    public function filterByOpis($opis = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($opis)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PrzepisTableMap::COL_OPIS, $opis, $comparison);
    }

    /**
     * Filter the query on the data_dodania column
     *
     * Example usage:
     * <code>
     * $query->filterByDataDodania('2011-03-14'); // WHERE data_dodania = '2011-03-14'
     * $query->filterByDataDodania('now'); // WHERE data_dodania = '2011-03-14'
     * $query->filterByDataDodania(array('max' => 'yesterday')); // WHERE data_dodania > '2011-03-13'
     * </code>
     *
     * @param     mixed $dataDodania The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPrzepisQuery The current query, for fluid interface
     */
    public function filterByDataDodania($dataDodania = null, $comparison = null)
    {
        if (is_array($dataDodania)) {
            $useMinMax = false;
            if (isset($dataDodania['min'])) {
                $this->addUsingAlias(PrzepisTableMap::COL_DATA_DODANIA, $dataDodania['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dataDodania['max'])) {
                $this->addUsingAlias(PrzepisTableMap::COL_DATA_DODANIA, $dataDodania['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PrzepisTableMap::COL_DATA_DODANIA, $dataDodania, $comparison);
    }

    /**
     * Filter the query on the status column
     *
     * Example usage:
     * <code>
     * $query->filterByStatus(1234); // WHERE status = 1234
     * $query->filterByStatus(array(12, 34)); // WHERE status IN (12, 34)
     * $query->filterByStatus(array('min' => 12)); // WHERE status > 12
     * </code>
     *
     * @param     mixed $status The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPrzepisQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (is_array($status)) {
            $useMinMax = false;
            if (isset($status['min'])) {
                $this->addUsingAlias(PrzepisTableMap::COL_STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                $this->addUsingAlias(PrzepisTableMap::COL_STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PrzepisTableMap::COL_STATUS, $status, $comparison);
    }

    /**
     * Filter the query on the zdjecie_ogolne column
     *
     * @param     mixed $zdjecieOgolne The value to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPrzepisQuery The current query, for fluid interface
     */
    public function filterByZdjecieOgolne($zdjecieOgolne = null, $comparison = null)
    {

        return $this->addUsingAlias(PrzepisTableMap::COL_ZDJECIE_OGOLNE, $zdjecieOgolne, $comparison);
    }

    /**
     * Filter the query on the UZYTKOWNIK_login column
     *
     * Example usage:
     * <code>
     * $query->filterByUzytkownikLogin('fooValue');   // WHERE UZYTKOWNIK_login = 'fooValue'
     * $query->filterByUzytkownikLogin('%fooValue%', Criteria::LIKE); // WHERE UZYTKOWNIK_login LIKE '%fooValue%'
     * </code>
     *
     * @param     string $uzytkownikLogin The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPrzepisQuery The current query, for fluid interface
     */
    public function filterByUzytkownikLogin($uzytkownikLogin = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($uzytkownikLogin)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PrzepisTableMap::COL_UZYTKOWNIK_LOGIN, $uzytkownikLogin, $comparison);
    }

    /**
     * Filter the query by a related \Uzytkownik object
     *
     * @param \Uzytkownik|ObjectCollection $uzytkownik The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPrzepisQuery The current query, for fluid interface
     */
    public function filterByUzytkownik($uzytkownik, $comparison = null)
    {
        if ($uzytkownik instanceof \Uzytkownik) {
            return $this
                ->addUsingAlias(PrzepisTableMap::COL_UZYTKOWNIK_LOGIN, $uzytkownik->getLogin(), $comparison);
        } elseif ($uzytkownik instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PrzepisTableMap::COL_UZYTKOWNIK_LOGIN, $uzytkownik->toKeyValue('PrimaryKey', 'Login'), $comparison);
        } else {
            throw new PropelException('filterByUzytkownik() only accepts arguments of type \Uzytkownik or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Uzytkownik relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPrzepisQuery The current query, for fluid interface
     */
    public function joinUzytkownik($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Uzytkownik');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Uzytkownik');
        }

        return $this;
    }

    /**
     * Use the Uzytkownik relation Uzytkownik object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \UzytkownikQuery A secondary query class using the current class as primary query
     */
    public function useUzytkownikQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUzytkownik($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Uzytkownik', '\UzytkownikQuery');
    }

    /**
     * Use the Uzytkownik relation Uzytkownik object
     *
     * @param callable(\UzytkownikQuery):\UzytkownikQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withUzytkownikQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useUzytkownikQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Filter the query by a related \Etap object
     *
     * @param \Etap|ObjectCollection $etap the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPrzepisQuery The current query, for fluid interface
     */
    public function filterByPRZEPIS_id_przepis($etap, $comparison = null)
    {
        if ($etap instanceof \Etap) {
            return $this
                ->addUsingAlias(PrzepisTableMap::COL_ID_PRZEPIS, $etap->getPrzepisIdPrzepis(), $comparison);
        } elseif ($etap instanceof ObjectCollection) {
            return $this
                ->usePRZEPIS_id_przepisQuery()
                ->filterByPrimaryKeys($etap->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPRZEPIS_id_przepis() only accepts arguments of type \Etap or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PRZEPIS_id_przepis relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPrzepisQuery The current query, for fluid interface
     */
    public function joinPRZEPIS_id_przepis($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PRZEPIS_id_przepis');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'PRZEPIS_id_przepis');
        }

        return $this;
    }

    /**
     * Use the PRZEPIS_id_przepis relation Etap object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \EtapQuery A secondary query class using the current class as primary query
     */
    public function usePRZEPIS_id_przepisQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPRZEPIS_id_przepis($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PRZEPIS_id_przepis', '\EtapQuery');
    }

    /**
     * Use the PRZEPIS_id_przepis relation Etap object
     *
     * @param callable(\EtapQuery):\EtapQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withPRZEPIS_id_przepisQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->usePRZEPIS_id_przepisQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Filter the query by a related \Ulubione object
     *
     * @param \Ulubione|ObjectCollection $ulubione the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPrzepisQuery The current query, for fluid interface
     */
    public function filterByPRZEPIS_id_przepis($ulubione, $comparison = null)
    {
        if ($ulubione instanceof \Ulubione) {
            return $this
                ->addUsingAlias(PrzepisTableMap::COL_ID_PRZEPIS, $ulubione->getPrzepisIdPrzepis(), $comparison);
        } elseif ($ulubione instanceof ObjectCollection) {
            return $this
                ->usePRZEPIS_id_przepisQuery()
                ->filterByPrimaryKeys($ulubione->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPRZEPIS_id_przepis() only accepts arguments of type \Ulubione or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PRZEPIS_id_przepis relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPrzepisQuery The current query, for fluid interface
     */
    public function joinPRZEPIS_id_przepis($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PRZEPIS_id_przepis');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'PRZEPIS_id_przepis');
        }

        return $this;
    }

    /**
     * Use the PRZEPIS_id_przepis relation Ulubione object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \UlubioneQuery A secondary query class using the current class as primary query
     */
    public function usePRZEPIS_id_przepisQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPRZEPIS_id_przepis($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PRZEPIS_id_przepis', '\UlubioneQuery');
    }

    /**
     * Use the PRZEPIS_id_przepis relation Ulubione object
     *
     * @param callable(\UlubioneQuery):\UlubioneQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withPRZEPIS_id_przepisQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->usePRZEPIS_id_przepisQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Filter the query by a related \Lubie_to object
     *
     * @param \Lubie_to|ObjectCollection $lubie_to the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPrzepisQuery The current query, for fluid interface
     */
    public function filterByPRZEPIS_id_przepis($lubie_to, $comparison = null)
    {
        if ($lubie_to instanceof \Lubie_to) {
            return $this
                ->addUsingAlias(PrzepisTableMap::COL_ID_PRZEPIS, $lubie_to->getPrzepisIdPrzepis(), $comparison);
        } elseif ($lubie_to instanceof ObjectCollection) {
            return $this
                ->usePRZEPIS_id_przepisQuery()
                ->filterByPrimaryKeys($lubie_to->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPRZEPIS_id_przepis() only accepts arguments of type \Lubie_to or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PRZEPIS_id_przepis relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPrzepisQuery The current query, for fluid interface
     */
    public function joinPRZEPIS_id_przepis($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PRZEPIS_id_przepis');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'PRZEPIS_id_przepis');
        }

        return $this;
    }

    /**
     * Use the PRZEPIS_id_przepis relation Lubie_to object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Lubie_toQuery A secondary query class using the current class as primary query
     */
    public function usePRZEPIS_id_przepisQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPRZEPIS_id_przepis($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PRZEPIS_id_przepis', '\Lubie_toQuery');
    }

    /**
     * Use the PRZEPIS_id_przepis relation Lubie_to object
     *
     * @param callable(\Lubie_toQuery):\Lubie_toQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withPRZEPIS_id_przepisQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->usePRZEPIS_id_przepisQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Filter the query by a related \Nalezy object
     *
     * @param \Nalezy|ObjectCollection $nalezy the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPrzepisQuery The current query, for fluid interface
     */
    public function filterByPRZEPIS_id_przepis($nalezy, $comparison = null)
    {
        if ($nalezy instanceof \Nalezy) {
            return $this
                ->addUsingAlias(PrzepisTableMap::COL_ID_PRZEPIS, $nalezy->getPrzepisIdPrzepis(), $comparison);
        } elseif ($nalezy instanceof ObjectCollection) {
            return $this
                ->usePRZEPIS_id_przepisQuery()
                ->filterByPrimaryKeys($nalezy->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPRZEPIS_id_przepis() only accepts arguments of type \Nalezy or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PRZEPIS_id_przepis relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPrzepisQuery The current query, for fluid interface
     */
    public function joinPRZEPIS_id_przepis($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PRZEPIS_id_przepis');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'PRZEPIS_id_przepis');
        }

        return $this;
    }

    /**
     * Use the PRZEPIS_id_przepis relation Nalezy object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \NalezyQuery A secondary query class using the current class as primary query
     */
    public function usePRZEPIS_id_przepisQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPRZEPIS_id_przepis($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PRZEPIS_id_przepis', '\NalezyQuery');
    }

    /**
     * Use the PRZEPIS_id_przepis relation Nalezy object
     *
     * @param callable(\NalezyQuery):\NalezyQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withPRZEPIS_id_przepisQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->usePRZEPIS_id_przepisQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Filter the query by a related \Zawiera object
     *
     * @param \Zawiera|ObjectCollection $zawiera the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPrzepisQuery The current query, for fluid interface
     */
    public function filterByPRZEPIS_id_przepis($zawiera, $comparison = null)
    {
        if ($zawiera instanceof \Zawiera) {
            return $this
                ->addUsingAlias(PrzepisTableMap::COL_ID_PRZEPIS, $zawiera->getPrzepisIdPrzepis(), $comparison);
        } elseif ($zawiera instanceof ObjectCollection) {
            return $this
                ->usePRZEPIS_id_przepisQuery()
                ->filterByPrimaryKeys($zawiera->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPRZEPIS_id_przepis() only accepts arguments of type \Zawiera or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PRZEPIS_id_przepis relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPrzepisQuery The current query, for fluid interface
     */
    public function joinPRZEPIS_id_przepis($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PRZEPIS_id_przepis');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'PRZEPIS_id_przepis');
        }

        return $this;
    }

    /**
     * Use the PRZEPIS_id_przepis relation Zawiera object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ZawieraQuery A secondary query class using the current class as primary query
     */
    public function usePRZEPIS_id_przepisQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPRZEPIS_id_przepis($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PRZEPIS_id_przepis', '\ZawieraQuery');
    }

    /**
     * Use the PRZEPIS_id_przepis relation Zawiera object
     *
     * @param callable(\ZawieraQuery):\ZawieraQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withPRZEPIS_id_przepisQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->usePRZEPIS_id_przepisQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param   ChildPrzepis $przepis Object to remove from the list of results
     *
     * @return $this|ChildPrzepisQuery The current query, for fluid interface
     */
    public function prune($przepis = null)
    {
        if ($przepis) {
            $this->addUsingAlias(PrzepisTableMap::COL_ID_PRZEPIS, $przepis->getIdPrzepis(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the przepis table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PrzepisTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PrzepisTableMap::clearInstancePool();
            PrzepisTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PrzepisTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PrzepisTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PrzepisTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PrzepisTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // PrzepisQuery
