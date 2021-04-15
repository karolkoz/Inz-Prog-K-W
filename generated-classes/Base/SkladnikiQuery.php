<?php

namespace Base;

use \Skladniki as ChildSkladniki;
use \SkladnikiQuery as ChildSkladnikiQuery;
use \Exception;
use \PDO;
use Map\SkladnikiTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'skladniki' table.
 *
 *
 *
 * @method     ChildSkladnikiQuery orderByIdSkladnik($order = Criteria::ASC) Order by the id_skladnik column
 * @method     ChildSkladnikiQuery orderByNazwa($order = Criteria::ASC) Order by the nazwa column
 *
 * @method     ChildSkladnikiQuery groupByIdSkladnik() Group by the id_skladnik column
 * @method     ChildSkladnikiQuery groupByNazwa() Group by the nazwa column
 *
 * @method     ChildSkladnikiQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSkladnikiQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSkladnikiQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSkladnikiQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSkladnikiQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSkladnikiQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSkladnikiQuery leftJoinZawiera($relationAlias = null) Adds a LEFT JOIN clause to the query using the Zawiera relation
 * @method     ChildSkladnikiQuery rightJoinZawiera($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Zawiera relation
 * @method     ChildSkladnikiQuery innerJoinZawiera($relationAlias = null) Adds a INNER JOIN clause to the query using the Zawiera relation
 *
 * @method     ChildSkladnikiQuery joinWithZawiera($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Zawiera relation
 *
 * @method     ChildSkladnikiQuery leftJoinWithZawiera() Adds a LEFT JOIN clause and with to the query using the Zawiera relation
 * @method     ChildSkladnikiQuery rightJoinWithZawiera() Adds a RIGHT JOIN clause and with to the query using the Zawiera relation
 * @method     ChildSkladnikiQuery innerJoinWithZawiera() Adds a INNER JOIN clause and with to the query using the Zawiera relation
 *
 * @method     \ZawieraQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSkladniki|null findOne(ConnectionInterface $con = null) Return the first ChildSkladniki matching the query
 * @method     ChildSkladniki findOneOrCreate(ConnectionInterface $con = null) Return the first ChildSkladniki matching the query, or a new ChildSkladniki object populated from the query conditions when no match is found
 *
 * @method     ChildSkladniki|null findOneByIdSkladnik(int $id_skladnik) Return the first ChildSkladniki filtered by the id_skladnik column
 * @method     ChildSkladniki|null findOneByNazwa(string $nazwa) Return the first ChildSkladniki filtered by the nazwa column *

 * @method     ChildSkladniki requirePk($key, ConnectionInterface $con = null) Return the ChildSkladniki by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSkladniki requireOne(ConnectionInterface $con = null) Return the first ChildSkladniki matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSkladniki requireOneByIdSkladnik(int $id_skladnik) Return the first ChildSkladniki filtered by the id_skladnik column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSkladniki requireOneByNazwa(string $nazwa) Return the first ChildSkladniki filtered by the nazwa column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSkladniki[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildSkladniki objects based on current ModelCriteria
 * @method     ChildSkladniki[]|ObjectCollection findByIdSkladnik(int $id_skladnik) Return ChildSkladniki objects filtered by the id_skladnik column
 * @method     ChildSkladniki[]|ObjectCollection findByNazwa(string $nazwa) Return ChildSkladniki objects filtered by the nazwa column
 * @method     ChildSkladniki[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class SkladnikiQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\SkladnikiQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'kulinaria', $modelName = '\\Skladniki', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSkladnikiQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSkladnikiQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildSkladnikiQuery) {
            return $criteria;
        }
        $query = new ChildSkladnikiQuery();
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
     * @return ChildSkladniki|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SkladnikiTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = SkladnikiTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSkladniki A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_skladnik, nazwa FROM skladniki WHERE id_skladnik = :p0';
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
            /** @var ChildSkladniki $obj */
            $obj = new ChildSkladniki();
            $obj->hydrate($row);
            SkladnikiTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSkladniki|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildSkladnikiQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(SkladnikiTableMap::COL_ID_SKLADNIK, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildSkladnikiQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(SkladnikiTableMap::COL_ID_SKLADNIK, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id_skladnik column
     *
     * Example usage:
     * <code>
     * $query->filterByIdSkladnik(1234); // WHERE id_skladnik = 1234
     * $query->filterByIdSkladnik(array(12, 34)); // WHERE id_skladnik IN (12, 34)
     * $query->filterByIdSkladnik(array('min' => 12)); // WHERE id_skladnik > 12
     * </code>
     *
     * @param     mixed $idSkladnik The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSkladnikiQuery The current query, for fluid interface
     */
    public function filterByIdSkladnik($idSkladnik = null, $comparison = null)
    {
        if (is_array($idSkladnik)) {
            $useMinMax = false;
            if (isset($idSkladnik['min'])) {
                $this->addUsingAlias(SkladnikiTableMap::COL_ID_SKLADNIK, $idSkladnik['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idSkladnik['max'])) {
                $this->addUsingAlias(SkladnikiTableMap::COL_ID_SKLADNIK, $idSkladnik['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SkladnikiTableMap::COL_ID_SKLADNIK, $idSkladnik, $comparison);
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
     * @return $this|ChildSkladnikiQuery The current query, for fluid interface
     */
    public function filterByNazwa($nazwa = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nazwa)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SkladnikiTableMap::COL_NAZWA, $nazwa, $comparison);
    }

    /**
     * Filter the query by a related \Zawiera object
     *
     * @param \Zawiera|ObjectCollection $zawiera the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildSkladnikiQuery The current query, for fluid interface
     */
    public function filterByZawiera($zawiera, $comparison = null)
    {
        if ($zawiera instanceof \Zawiera) {
            return $this
                ->addUsingAlias(SkladnikiTableMap::COL_ID_SKLADNIK, $zawiera->getSkladnikiIdSkladnik(), $comparison);
        } elseif ($zawiera instanceof ObjectCollection) {
            return $this
                ->useZawieraQuery()
                ->filterByPrimaryKeys($zawiera->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByZawiera() only accepts arguments of type \Zawiera or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Zawiera relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSkladnikiQuery The current query, for fluid interface
     */
    public function joinZawiera($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Zawiera');

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
            $this->addJoinObject($join, 'Zawiera');
        }

        return $this;
    }

    /**
     * Use the Zawiera relation Zawiera object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ZawieraQuery A secondary query class using the current class as primary query
     */
    public function useZawieraQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinZawiera($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Zawiera', '\ZawieraQuery');
    }

    /**
     * Use the Zawiera relation Zawiera object
     *
     * @param callable(\ZawieraQuery):\ZawieraQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withZawieraQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useZawieraQuery(
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
     * @param   ChildSkladniki $skladniki Object to remove from the list of results
     *
     * @return $this|ChildSkladnikiQuery The current query, for fluid interface
     */
    public function prune($skladniki = null)
    {
        if ($skladniki) {
            $this->addUsingAlias(SkladnikiTableMap::COL_ID_SKLADNIK, $skladniki->getIdSkladnik(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the skladniki table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SkladnikiTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SkladnikiTableMap::clearInstancePool();
            SkladnikiTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SkladnikiTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SkladnikiTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SkladnikiTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SkladnikiTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // SkladnikiQuery
