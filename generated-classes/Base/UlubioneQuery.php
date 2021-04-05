<?php

namespace Base;

use \Ulubione as ChildUlubione;
use \UlubioneQuery as ChildUlubioneQuery;
use \Exception;
use \PDO;
use Map\UlubioneTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'ulubione' table.
 *
 *
 *
 * @method     ChildUlubioneQuery orderByUzytkownikLogin($order = Criteria::ASC) Order by the UZYTKOWNIK_login column
 * @method     ChildUlubioneQuery orderByPrzepisIdPrzepis($order = Criteria::ASC) Order by the PRZEPIS_id_przepis column
 *
 * @method     ChildUlubioneQuery groupByUzytkownikLogin() Group by the UZYTKOWNIK_login column
 * @method     ChildUlubioneQuery groupByPrzepisIdPrzepis() Group by the PRZEPIS_id_przepis column
 *
 * @method     ChildUlubioneQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUlubioneQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUlubioneQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUlubioneQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildUlubioneQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildUlubioneQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildUlubioneQuery leftJoinUzytkownik($relationAlias = null) Adds a LEFT JOIN clause to the query using the Uzytkownik relation
 * @method     ChildUlubioneQuery rightJoinUzytkownik($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Uzytkownik relation
 * @method     ChildUlubioneQuery innerJoinUzytkownik($relationAlias = null) Adds a INNER JOIN clause to the query using the Uzytkownik relation
 *
 * @method     ChildUlubioneQuery joinWithUzytkownik($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Uzytkownik relation
 *
 * @method     ChildUlubioneQuery leftJoinWithUzytkownik() Adds a LEFT JOIN clause and with to the query using the Uzytkownik relation
 * @method     ChildUlubioneQuery rightJoinWithUzytkownik() Adds a RIGHT JOIN clause and with to the query using the Uzytkownik relation
 * @method     ChildUlubioneQuery innerJoinWithUzytkownik() Adds a INNER JOIN clause and with to the query using the Uzytkownik relation
 *
 * @method     ChildUlubioneQuery leftJoinPrzepis($relationAlias = null) Adds a LEFT JOIN clause to the query using the Przepis relation
 * @method     ChildUlubioneQuery rightJoinPrzepis($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Przepis relation
 * @method     ChildUlubioneQuery innerJoinPrzepis($relationAlias = null) Adds a INNER JOIN clause to the query using the Przepis relation
 *
 * @method     ChildUlubioneQuery joinWithPrzepis($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Przepis relation
 *
 * @method     ChildUlubioneQuery leftJoinWithPrzepis() Adds a LEFT JOIN clause and with to the query using the Przepis relation
 * @method     ChildUlubioneQuery rightJoinWithPrzepis() Adds a RIGHT JOIN clause and with to the query using the Przepis relation
 * @method     ChildUlubioneQuery innerJoinWithPrzepis() Adds a INNER JOIN clause and with to the query using the Przepis relation
 *
 * @method     \UzytkownikQuery|\PrzepisQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildUlubione|null findOne(ConnectionInterface $con = null) Return the first ChildUlubione matching the query
 * @method     ChildUlubione findOneOrCreate(ConnectionInterface $con = null) Return the first ChildUlubione matching the query, or a new ChildUlubione object populated from the query conditions when no match is found
 *
 * @method     ChildUlubione|null findOneByUzytkownikLogin(string $UZYTKOWNIK_login) Return the first ChildUlubione filtered by the UZYTKOWNIK_login column
 * @method     ChildUlubione|null findOneByPrzepisIdPrzepis(int $PRZEPIS_id_przepis) Return the first ChildUlubione filtered by the PRZEPIS_id_przepis column *

 * @method     ChildUlubione requirePk($key, ConnectionInterface $con = null) Return the ChildUlubione by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUlubione requireOne(ConnectionInterface $con = null) Return the first ChildUlubione matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUlubione requireOneByUzytkownikLogin(string $UZYTKOWNIK_login) Return the first ChildUlubione filtered by the UZYTKOWNIK_login column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUlubione requireOneByPrzepisIdPrzepis(int $PRZEPIS_id_przepis) Return the first ChildUlubione filtered by the PRZEPIS_id_przepis column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUlubione[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildUlubione objects based on current ModelCriteria
 * @method     ChildUlubione[]|ObjectCollection findByUzytkownikLogin(string $UZYTKOWNIK_login) Return ChildUlubione objects filtered by the UZYTKOWNIK_login column
 * @method     ChildUlubione[]|ObjectCollection findByPrzepisIdPrzepis(int $PRZEPIS_id_przepis) Return ChildUlubione objects filtered by the PRZEPIS_id_przepis column
 * @method     ChildUlubione[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class UlubioneQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\UlubioneQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'kulinaria', $modelName = '\\Ulubione', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUlubioneQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUlubioneQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildUlubioneQuery) {
            return $criteria;
        }
        $query = new ChildUlubioneQuery();
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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array[$UZYTKOWNIK_login, $PRZEPIS_id_przepis] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildUlubione|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UlubioneTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = UlubioneTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildUlubione A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT UZYTKOWNIK_login, PRZEPIS_id_przepis FROM ulubione WHERE UZYTKOWNIK_login = :p0 AND PRZEPIS_id_przepis = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_STR);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildUlubione $obj */
            $obj = new ChildUlubione();
            $obj->hydrate($row);
            UlubioneTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildUlubione|array|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
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
     * @return $this|ChildUlubioneQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(UlubioneTableMap::COL_UZYTKOWNIK_LOGIN, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(UlubioneTableMap::COL_PRZEPIS_ID_PRZEPIS, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildUlubioneQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(UlubioneTableMap::COL_UZYTKOWNIK_LOGIN, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(UlubioneTableMap::COL_PRZEPIS_ID_PRZEPIS, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
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
     * @return $this|ChildUlubioneQuery The current query, for fluid interface
     */
    public function filterByUzytkownikLogin($uzytkownikLogin = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($uzytkownikLogin)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UlubioneTableMap::COL_UZYTKOWNIK_LOGIN, $uzytkownikLogin, $comparison);
    }

    /**
     * Filter the query on the PRZEPIS_id_przepis column
     *
     * Example usage:
     * <code>
     * $query->filterByPrzepisIdPrzepis(1234); // WHERE PRZEPIS_id_przepis = 1234
     * $query->filterByPrzepisIdPrzepis(array(12, 34)); // WHERE PRZEPIS_id_przepis IN (12, 34)
     * $query->filterByPrzepisIdPrzepis(array('min' => 12)); // WHERE PRZEPIS_id_przepis > 12
     * </code>
     *
     * @see       filterByPrzepis()
     *
     * @param     mixed $przepisIdPrzepis The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUlubioneQuery The current query, for fluid interface
     */
    public function filterByPrzepisIdPrzepis($przepisIdPrzepis = null, $comparison = null)
    {
        if (is_array($przepisIdPrzepis)) {
            $useMinMax = false;
            if (isset($przepisIdPrzepis['min'])) {
                $this->addUsingAlias(UlubioneTableMap::COL_PRZEPIS_ID_PRZEPIS, $przepisIdPrzepis['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($przepisIdPrzepis['max'])) {
                $this->addUsingAlias(UlubioneTableMap::COL_PRZEPIS_ID_PRZEPIS, $przepisIdPrzepis['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UlubioneTableMap::COL_PRZEPIS_ID_PRZEPIS, $przepisIdPrzepis, $comparison);
    }

    /**
     * Filter the query by a related \Uzytkownik object
     *
     * @param \Uzytkownik|ObjectCollection $uzytkownik The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildUlubioneQuery The current query, for fluid interface
     */
    public function filterByUzytkownik($uzytkownik, $comparison = null)
    {
        if ($uzytkownik instanceof \Uzytkownik) {
            return $this
                ->addUsingAlias(UlubioneTableMap::COL_UZYTKOWNIK_LOGIN, $uzytkownik->getLogin(), $comparison);
        } elseif ($uzytkownik instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(UlubioneTableMap::COL_UZYTKOWNIK_LOGIN, $uzytkownik->toKeyValue('PrimaryKey', 'Login'), $comparison);
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
     * @return $this|ChildUlubioneQuery The current query, for fluid interface
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
     * Filter the query by a related \Przepis object
     *
     * @param \Przepis|ObjectCollection $przepis The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildUlubioneQuery The current query, for fluid interface
     */
    public function filterByPrzepis($przepis, $comparison = null)
    {
        if ($przepis instanceof \Przepis) {
            return $this
                ->addUsingAlias(UlubioneTableMap::COL_PRZEPIS_ID_PRZEPIS, $przepis->getIdPrzepis(), $comparison);
        } elseif ($przepis instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(UlubioneTableMap::COL_PRZEPIS_ID_PRZEPIS, $przepis->toKeyValue('PrimaryKey', 'IdPrzepis'), $comparison);
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
     * @return $this|ChildUlubioneQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   ChildUlubione $ulubione Object to remove from the list of results
     *
     * @return $this|ChildUlubioneQuery The current query, for fluid interface
     */
    public function prune($ulubione = null)
    {
        if ($ulubione) {
            $this->addCond('pruneCond0', $this->getAliasedColName(UlubioneTableMap::COL_UZYTKOWNIK_LOGIN), $ulubione->getUzytkownikLogin(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(UlubioneTableMap::COL_PRZEPIS_ID_PRZEPIS), $ulubione->getPrzepisIdPrzepis(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the ulubione table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UlubioneTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UlubioneTableMap::clearInstancePool();
            UlubioneTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(UlubioneTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UlubioneTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            UlubioneTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            UlubioneTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // UlubioneQuery
