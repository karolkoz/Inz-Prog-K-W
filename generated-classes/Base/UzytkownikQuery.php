<?php

namespace Base;

use \Uzytkownik as ChildUzytkownik;
use \UzytkownikQuery as ChildUzytkownikQuery;
use \Exception;
use \PDO;
use Map\UzytkownikTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'uzytkownik' table.
 *
 *
 *
 * @method     ChildUzytkownikQuery orderByLogin($order = Criteria::ASC) Order by the login column
 * @method     ChildUzytkownikQuery orderByNazwa($order = Criteria::ASC) Order by the nazwa column
 * @method     ChildUzytkownikQuery orderByHaslo($order = Criteria::ASC) Order by the haslo column
 * @method     ChildUzytkownikQuery orderByRodzajKonta($order = Criteria::ASC) Order by the rodzaj_konta column
 * @method     ChildUzytkownikQuery orderByStatusKonta($order = Criteria::ASC) Order by the status_konta column
 *
 * @method     ChildUzytkownikQuery groupByLogin() Group by the login column
 * @method     ChildUzytkownikQuery groupByNazwa() Group by the nazwa column
 * @method     ChildUzytkownikQuery groupByHaslo() Group by the haslo column
 * @method     ChildUzytkownikQuery groupByRodzajKonta() Group by the rodzaj_konta column
 * @method     ChildUzytkownikQuery groupByStatusKonta() Group by the status_konta column
 *
 * @method     ChildUzytkownikQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUzytkownikQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUzytkownikQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUzytkownikQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildUzytkownikQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildUzytkownikQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildUzytkownikQuery leftJoinPrzepis($relationAlias = null) Adds a LEFT JOIN clause to the query using the Przepis relation
 * @method     ChildUzytkownikQuery rightJoinPrzepis($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Przepis relation
 * @method     ChildUzytkownikQuery innerJoinPrzepis($relationAlias = null) Adds a INNER JOIN clause to the query using the Przepis relation
 *
 * @method     ChildUzytkownikQuery joinWithPrzepis($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Przepis relation
 *
 * @method     ChildUzytkownikQuery leftJoinWithPrzepis() Adds a LEFT JOIN clause and with to the query using the Przepis relation
 * @method     ChildUzytkownikQuery rightJoinWithPrzepis() Adds a RIGHT JOIN clause and with to the query using the Przepis relation
 * @method     ChildUzytkownikQuery innerJoinWithPrzepis() Adds a INNER JOIN clause and with to the query using the Przepis relation
 *
 * @method     ChildUzytkownikQuery leftJoinUlubione($relationAlias = null) Adds a LEFT JOIN clause to the query using the Ulubione relation
 * @method     ChildUzytkownikQuery rightJoinUlubione($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Ulubione relation
 * @method     ChildUzytkownikQuery innerJoinUlubione($relationAlias = null) Adds a INNER JOIN clause to the query using the Ulubione relation
 *
 * @method     ChildUzytkownikQuery joinWithUlubione($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Ulubione relation
 *
 * @method     ChildUzytkownikQuery leftJoinWithUlubione() Adds a LEFT JOIN clause and with to the query using the Ulubione relation
 * @method     ChildUzytkownikQuery rightJoinWithUlubione() Adds a RIGHT JOIN clause and with to the query using the Ulubione relation
 * @method     ChildUzytkownikQuery innerJoinWithUlubione() Adds a INNER JOIN clause and with to the query using the Ulubione relation
 *
 * @method     ChildUzytkownikQuery leftJoinLubie_to($relationAlias = null) Adds a LEFT JOIN clause to the query using the Lubie_to relation
 * @method     ChildUzytkownikQuery rightJoinLubie_to($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Lubie_to relation
 * @method     ChildUzytkownikQuery innerJoinLubie_to($relationAlias = null) Adds a INNER JOIN clause to the query using the Lubie_to relation
 *
 * @method     ChildUzytkownikQuery joinWithLubie_to($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Lubie_to relation
 *
 * @method     ChildUzytkownikQuery leftJoinWithLubie_to() Adds a LEFT JOIN clause and with to the query using the Lubie_to relation
 * @method     ChildUzytkownikQuery rightJoinWithLubie_to() Adds a RIGHT JOIN clause and with to the query using the Lubie_to relation
 * @method     ChildUzytkownikQuery innerJoinWithLubie_to() Adds a INNER JOIN clause and with to the query using the Lubie_to relation
 *
 * @method     \PrzepisQuery|\UlubioneQuery|\Lubie_toQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildUzytkownik|null findOne(ConnectionInterface $con = null) Return the first ChildUzytkownik matching the query
 * @method     ChildUzytkownik findOneOrCreate(ConnectionInterface $con = null) Return the first ChildUzytkownik matching the query, or a new ChildUzytkownik object populated from the query conditions when no match is found
 *
 * @method     ChildUzytkownik|null findOneByLogin(string $login) Return the first ChildUzytkownik filtered by the login column
 * @method     ChildUzytkownik|null findOneByNazwa(string $nazwa) Return the first ChildUzytkownik filtered by the nazwa column
 * @method     ChildUzytkownik|null findOneByHaslo(string $haslo) Return the first ChildUzytkownik filtered by the haslo column
 * @method     ChildUzytkownik|null findOneByRodzajKonta(int $rodzaj_konta) Return the first ChildUzytkownik filtered by the rodzaj_konta column
 * @method     ChildUzytkownik|null findOneByStatusKonta(int $status_konta) Return the first ChildUzytkownik filtered by the status_konta column *

 * @method     ChildUzytkownik requirePk($key, ConnectionInterface $con = null) Return the ChildUzytkownik by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUzytkownik requireOne(ConnectionInterface $con = null) Return the first ChildUzytkownik matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUzytkownik requireOneByLogin(string $login) Return the first ChildUzytkownik filtered by the login column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUzytkownik requireOneByNazwa(string $nazwa) Return the first ChildUzytkownik filtered by the nazwa column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUzytkownik requireOneByHaslo(string $haslo) Return the first ChildUzytkownik filtered by the haslo column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUzytkownik requireOneByRodzajKonta(int $rodzaj_konta) Return the first ChildUzytkownik filtered by the rodzaj_konta column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUzytkownik requireOneByStatusKonta(int $status_konta) Return the first ChildUzytkownik filtered by the status_konta column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUzytkownik[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildUzytkownik objects based on current ModelCriteria
 * @method     ChildUzytkownik[]|ObjectCollection findByLogin(string $login) Return ChildUzytkownik objects filtered by the login column
 * @method     ChildUzytkownik[]|ObjectCollection findByNazwa(string $nazwa) Return ChildUzytkownik objects filtered by the nazwa column
 * @method     ChildUzytkownik[]|ObjectCollection findByHaslo(string $haslo) Return ChildUzytkownik objects filtered by the haslo column
 * @method     ChildUzytkownik[]|ObjectCollection findByRodzajKonta(int $rodzaj_konta) Return ChildUzytkownik objects filtered by the rodzaj_konta column
 * @method     ChildUzytkownik[]|ObjectCollection findByStatusKonta(int $status_konta) Return ChildUzytkownik objects filtered by the status_konta column
 * @method     ChildUzytkownik[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class UzytkownikQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\UzytkownikQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'kulinaria', $modelName = '\\Uzytkownik', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUzytkownikQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUzytkownikQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildUzytkownikQuery) {
            return $criteria;
        }
        $query = new ChildUzytkownikQuery();
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
     * @return ChildUzytkownik|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UzytkownikTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = UzytkownikTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildUzytkownik A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT login, nazwa, haslo, rodzaj_konta, status_konta FROM uzytkownik WHERE login = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildUzytkownik $obj */
            $obj = new ChildUzytkownik();
            $obj->hydrate($row);
            UzytkownikTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildUzytkownik|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildUzytkownikQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(UzytkownikTableMap::COL_LOGIN, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildUzytkownikQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(UzytkownikTableMap::COL_LOGIN, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the login column
     *
     * Example usage:
     * <code>
     * $query->filterByLogin('fooValue');   // WHERE login = 'fooValue'
     * $query->filterByLogin('%fooValue%', Criteria::LIKE); // WHERE login LIKE '%fooValue%'
     * </code>
     *
     * @param     string $login The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUzytkownikQuery The current query, for fluid interface
     */
    public function filterByLogin($login = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($login)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UzytkownikTableMap::COL_LOGIN, $login, $comparison);
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
     * @return $this|ChildUzytkownikQuery The current query, for fluid interface
     */
    public function filterByNazwa($nazwa = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nazwa)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UzytkownikTableMap::COL_NAZWA, $nazwa, $comparison);
    }

    /**
     * Filter the query on the haslo column
     *
     * Example usage:
     * <code>
     * $query->filterByHaslo('fooValue');   // WHERE haslo = 'fooValue'
     * $query->filterByHaslo('%fooValue%', Criteria::LIKE); // WHERE haslo LIKE '%fooValue%'
     * </code>
     *
     * @param     string $haslo The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUzytkownikQuery The current query, for fluid interface
     */
    public function filterByHaslo($haslo = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($haslo)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UzytkownikTableMap::COL_HASLO, $haslo, $comparison);
    }

    /**
     * Filter the query on the rodzaj_konta column
     *
     * Example usage:
     * <code>
     * $query->filterByRodzajKonta(1234); // WHERE rodzaj_konta = 1234
     * $query->filterByRodzajKonta(array(12, 34)); // WHERE rodzaj_konta IN (12, 34)
     * $query->filterByRodzajKonta(array('min' => 12)); // WHERE rodzaj_konta > 12
     * </code>
     *
     * @param     mixed $rodzajKonta The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUzytkownikQuery The current query, for fluid interface
     */
    public function filterByRodzajKonta($rodzajKonta = null, $comparison = null)
    {
        if (is_array($rodzajKonta)) {
            $useMinMax = false;
            if (isset($rodzajKonta['min'])) {
                $this->addUsingAlias(UzytkownikTableMap::COL_RODZAJ_KONTA, $rodzajKonta['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($rodzajKonta['max'])) {
                $this->addUsingAlias(UzytkownikTableMap::COL_RODZAJ_KONTA, $rodzajKonta['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UzytkownikTableMap::COL_RODZAJ_KONTA, $rodzajKonta, $comparison);
    }

    /**
     * Filter the query on the status_konta column
     *
     * Example usage:
     * <code>
     * $query->filterByStatusKonta(1234); // WHERE status_konta = 1234
     * $query->filterByStatusKonta(array(12, 34)); // WHERE status_konta IN (12, 34)
     * $query->filterByStatusKonta(array('min' => 12)); // WHERE status_konta > 12
     * </code>
     *
     * @param     mixed $statusKonta The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUzytkownikQuery The current query, for fluid interface
     */
    public function filterByStatusKonta($statusKonta = null, $comparison = null)
    {
        if (is_array($statusKonta)) {
            $useMinMax = false;
            if (isset($statusKonta['min'])) {
                $this->addUsingAlias(UzytkownikTableMap::COL_STATUS_KONTA, $statusKonta['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($statusKonta['max'])) {
                $this->addUsingAlias(UzytkownikTableMap::COL_STATUS_KONTA, $statusKonta['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UzytkownikTableMap::COL_STATUS_KONTA, $statusKonta, $comparison);
    }

    /**
     * Filter the query by a related \Przepis object
     *
     * @param \Przepis|ObjectCollection $przepis the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUzytkownikQuery The current query, for fluid interface
     */
    public function filterByPrzepis($przepis, $comparison = null)
    {
        if ($przepis instanceof \Przepis) {
            return $this
                ->addUsingAlias(UzytkownikTableMap::COL_LOGIN, $przepis->getUzytkownikLogin(), $comparison);
        } elseif ($przepis instanceof ObjectCollection) {
            return $this
                ->usePrzepisQuery()
                ->filterByPrimaryKeys($przepis->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPrzepis() only accepts arguments of type \Przepis or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Przepis relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUzytkownikQuery The current query, for fluid interface
     */
    public function joinPrzepis($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Przepis');

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
            $this->addJoinObject($join, 'Przepis');
        }

        return $this;
    }

    /**
     * Use the Przepis relation Przepis object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PrzepisQuery A secondary query class using the current class as primary query
     */
    public function usePrzepisQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPrzepis($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Przepis', '\PrzepisQuery');
    }

    /**
     * Use the Przepis relation Przepis object
     *
     * @param callable(\PrzepisQuery):\PrzepisQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withPrzepisQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->usePrzepisQuery(
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
     * @return ChildUzytkownikQuery The current query, for fluid interface
     */
    public function filterByUlubione($ulubione, $comparison = null)
    {
        if ($ulubione instanceof \Ulubione) {
            return $this
                ->addUsingAlias(UzytkownikTableMap::COL_LOGIN, $ulubione->getUzytkownikLogin(), $comparison);
        } elseif ($ulubione instanceof ObjectCollection) {
            return $this
                ->useUlubioneQuery()
                ->filterByPrimaryKeys($ulubione->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByUlubione() only accepts arguments of type \Ulubione or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Ulubione relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUzytkownikQuery The current query, for fluid interface
     */
    public function joinUlubione($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Ulubione');

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
            $this->addJoinObject($join, 'Ulubione');
        }

        return $this;
    }

    /**
     * Use the Ulubione relation Ulubione object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \UlubioneQuery A secondary query class using the current class as primary query
     */
    public function useUlubioneQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUlubione($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Ulubione', '\UlubioneQuery');
    }

    /**
     * Use the Ulubione relation Ulubione object
     *
     * @param callable(\UlubioneQuery):\UlubioneQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withUlubioneQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useUlubioneQuery(
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
     * @return ChildUzytkownikQuery The current query, for fluid interface
     */
    public function filterByLubie_to($lubie_to, $comparison = null)
    {
        if ($lubie_to instanceof \Lubie_to) {
            return $this
                ->addUsingAlias(UzytkownikTableMap::COL_LOGIN, $lubie_to->getUzytkownikLogin(), $comparison);
        } elseif ($lubie_to instanceof ObjectCollection) {
            return $this
                ->useLubie_toQuery()
                ->filterByPrimaryKeys($lubie_to->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByLubie_to() only accepts arguments of type \Lubie_to or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Lubie_to relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUzytkownikQuery The current query, for fluid interface
     */
    public function joinLubie_to($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Lubie_to');

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
            $this->addJoinObject($join, 'Lubie_to');
        }

        return $this;
    }

    /**
     * Use the Lubie_to relation Lubie_to object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Lubie_toQuery A secondary query class using the current class as primary query
     */
    public function useLubie_toQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinLubie_to($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Lubie_to', '\Lubie_toQuery');
    }

    /**
     * Use the Lubie_to relation Lubie_to object
     *
     * @param callable(\Lubie_toQuery):\Lubie_toQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withLubie_toQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useLubie_toQuery(
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
     * @param   ChildUzytkownik $uzytkownik Object to remove from the list of results
     *
     * @return $this|ChildUzytkownikQuery The current query, for fluid interface
     */
    public function prune($uzytkownik = null)
    {
        if ($uzytkownik) {
            $this->addUsingAlias(UzytkownikTableMap::COL_LOGIN, $uzytkownik->getLogin(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the uzytkownik table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UzytkownikTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UzytkownikTableMap::clearInstancePool();
            UzytkownikTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(UzytkownikTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UzytkownikTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            UzytkownikTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            UzytkownikTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // UzytkownikQuery
