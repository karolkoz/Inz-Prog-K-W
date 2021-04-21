<?php

namespace Base;

use \Etap as ChildEtap;
use \EtapQuery as ChildEtapQuery;
use \Exception;
use \PDO;
use Map\EtapTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'etap' table.
 *
 *
 *
 * @method     ChildEtapQuery orderByIdEtap($order = Criteria::ASC) Order by the id_etap column
 * @method     ChildEtapQuery orderByNrEtapu($order = Criteria::ASC) Order by the nr_etapu column
 * @method     ChildEtapQuery orderByOpis($order = Criteria::ASC) Order by the opis column
 * @method     ChildEtapQuery orderByZdjecie($order = Criteria::ASC) Order by the zdjecie column
 * @method     ChildEtapQuery orderByPrzepisIdPrzepis($order = Criteria::ASC) Order by the PRZEPIS_id_przepis column
 *
 * @method     ChildEtapQuery groupByIdEtap() Group by the id_etap column
 * @method     ChildEtapQuery groupByNrEtapu() Group by the nr_etapu column
 * @method     ChildEtapQuery groupByOpis() Group by the opis column
 * @method     ChildEtapQuery groupByZdjecie() Group by the zdjecie column
 * @method     ChildEtapQuery groupByPrzepisIdPrzepis() Group by the PRZEPIS_id_przepis column
 *
 * @method     ChildEtapQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildEtapQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildEtapQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildEtapQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildEtapQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildEtapQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildEtapQuery leftJoinPrzepis($relationAlias = null) Adds a LEFT JOIN clause to the query using the Przepis relation
 * @method     ChildEtapQuery rightJoinPrzepis($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Przepis relation
 * @method     ChildEtapQuery innerJoinPrzepis($relationAlias = null) Adds a INNER JOIN clause to the query using the Przepis relation
 *
 * @method     ChildEtapQuery joinWithPrzepis($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Przepis relation
 *
 * @method     ChildEtapQuery leftJoinWithPrzepis() Adds a LEFT JOIN clause and with to the query using the Przepis relation
 * @method     ChildEtapQuery rightJoinWithPrzepis() Adds a RIGHT JOIN clause and with to the query using the Przepis relation
 * @method     ChildEtapQuery innerJoinWithPrzepis() Adds a INNER JOIN clause and with to the query using the Przepis relation
 *
 * @method     \PrzepisQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildEtap|null findOne(ConnectionInterface $con = null) Return the first ChildEtap matching the query
 * @method     ChildEtap findOneOrCreate(ConnectionInterface $con = null) Return the first ChildEtap matching the query, or a new ChildEtap object populated from the query conditions when no match is found
 *
 * @method     ChildEtap|null findOneByIdEtap(int $id_etap) Return the first ChildEtap filtered by the id_etap column
 * @method     ChildEtap|null findOneByNrEtapu(int $nr_etapu) Return the first ChildEtap filtered by the nr_etapu column
 * @method     ChildEtap|null findOneByOpis(string $opis) Return the first ChildEtap filtered by the opis column
 * @method     ChildEtap|null findOneByZdjecie(string $zdjecie) Return the first ChildEtap filtered by the zdjecie column
 * @method     ChildEtap|null findOneByPrzepisIdPrzepis(int $PRZEPIS_id_przepis) Return the first ChildEtap filtered by the PRZEPIS_id_przepis column *

 * @method     ChildEtap requirePk($key, ConnectionInterface $con = null) Return the ChildEtap by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEtap requireOne(ConnectionInterface $con = null) Return the first ChildEtap matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEtap requireOneByIdEtap(int $id_etap) Return the first ChildEtap filtered by the id_etap column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEtap requireOneByNrEtapu(int $nr_etapu) Return the first ChildEtap filtered by the nr_etapu column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEtap requireOneByOpis(string $opis) Return the first ChildEtap filtered by the opis column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEtap requireOneByZdjecie(string $zdjecie) Return the first ChildEtap filtered by the zdjecie column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEtap requireOneByPrzepisIdPrzepis(int $PRZEPIS_id_przepis) Return the first ChildEtap filtered by the PRZEPIS_id_przepis column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEtap[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildEtap objects based on current ModelCriteria
 * @method     ChildEtap[]|ObjectCollection findByIdEtap(int $id_etap) Return ChildEtap objects filtered by the id_etap column
 * @method     ChildEtap[]|ObjectCollection findByNrEtapu(int $nr_etapu) Return ChildEtap objects filtered by the nr_etapu column
 * @method     ChildEtap[]|ObjectCollection findByOpis(string $opis) Return ChildEtap objects filtered by the opis column
 * @method     ChildEtap[]|ObjectCollection findByZdjecie(string $zdjecie) Return ChildEtap objects filtered by the zdjecie column
 * @method     ChildEtap[]|ObjectCollection findByPrzepisIdPrzepis(int $PRZEPIS_id_przepis) Return ChildEtap objects filtered by the PRZEPIS_id_przepis column
 * @method     ChildEtap[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class EtapQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\EtapQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'kulinaria', $modelName = '\\Etap', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildEtapQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildEtapQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildEtapQuery) {
            return $criteria;
        }
        $query = new ChildEtapQuery();
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
     * @return ChildEtap|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(EtapTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = EtapTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildEtap A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_etap, nr_etapu, opis, zdjecie, PRZEPIS_id_przepis FROM etap WHERE id_etap = :p0';
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
            /** @var ChildEtap $obj */
            $obj = new ChildEtap();
            $obj->hydrate($row);
            EtapTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildEtap|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildEtapQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(EtapTableMap::COL_ID_ETAP, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildEtapQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(EtapTableMap::COL_ID_ETAP, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id_etap column
     *
     * Example usage:
     * <code>
     * $query->filterByIdEtap(1234); // WHERE id_etap = 1234
     * $query->filterByIdEtap(array(12, 34)); // WHERE id_etap IN (12, 34)
     * $query->filterByIdEtap(array('min' => 12)); // WHERE id_etap > 12
     * </code>
     *
     * @param     mixed $idEtap The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEtapQuery The current query, for fluid interface
     */
    public function filterByIdEtap($idEtap = null, $comparison = null)
    {
        if (is_array($idEtap)) {
            $useMinMax = false;
            if (isset($idEtap['min'])) {
                $this->addUsingAlias(EtapTableMap::COL_ID_ETAP, $idEtap['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idEtap['max'])) {
                $this->addUsingAlias(EtapTableMap::COL_ID_ETAP, $idEtap['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EtapTableMap::COL_ID_ETAP, $idEtap, $comparison);
    }

    /**
     * Filter the query on the nr_etapu column
     *
     * Example usage:
     * <code>
     * $query->filterByNrEtapu(1234); // WHERE nr_etapu = 1234
     * $query->filterByNrEtapu(array(12, 34)); // WHERE nr_etapu IN (12, 34)
     * $query->filterByNrEtapu(array('min' => 12)); // WHERE nr_etapu > 12
     * </code>
     *
     * @param     mixed $nrEtapu The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEtapQuery The current query, for fluid interface
     */
    public function filterByNrEtapu($nrEtapu = null, $comparison = null)
    {
        if (is_array($nrEtapu)) {
            $useMinMax = false;
            if (isset($nrEtapu['min'])) {
                $this->addUsingAlias(EtapTableMap::COL_NR_ETAPU, $nrEtapu['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($nrEtapu['max'])) {
                $this->addUsingAlias(EtapTableMap::COL_NR_ETAPU, $nrEtapu['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EtapTableMap::COL_NR_ETAPU, $nrEtapu, $comparison);
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
     * @return $this|ChildEtapQuery The current query, for fluid interface
     */
    public function filterByOpis($opis = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($opis)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EtapTableMap::COL_OPIS, $opis, $comparison);
    }

    /**
     * Filter the query on the zdjecie column
     *
     * @param     mixed $zdjecie The value to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEtapQuery The current query, for fluid interface
     */
    public function filterByZdjecie($zdjecie = null, $comparison = null)
    {

        return $this->addUsingAlias(EtapTableMap::COL_ZDJECIE, $zdjecie, $comparison);
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
     * @return $this|ChildEtapQuery The current query, for fluid interface
     */
    public function filterByPrzepisIdPrzepis($przepisIdPrzepis = null, $comparison = null)
    {
        if (is_array($przepisIdPrzepis)) {
            $useMinMax = false;
            if (isset($przepisIdPrzepis['min'])) {
                $this->addUsingAlias(EtapTableMap::COL_PRZEPIS_ID_PRZEPIS, $przepisIdPrzepis['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($przepisIdPrzepis['max'])) {
                $this->addUsingAlias(EtapTableMap::COL_PRZEPIS_ID_PRZEPIS, $przepisIdPrzepis['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EtapTableMap::COL_PRZEPIS_ID_PRZEPIS, $przepisIdPrzepis, $comparison);
    }

    /**
     * Filter the query by a related \Przepis object
     *
     * @param \Przepis|ObjectCollection $przepis The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildEtapQuery The current query, for fluid interface
     */
    public function filterByPrzepis($przepis, $comparison = null)
    {
        if ($przepis instanceof \Przepis) {
            return $this
                ->addUsingAlias(EtapTableMap::COL_PRZEPIS_ID_PRZEPIS, $przepis->getIdPrzepis(), $comparison);
        } elseif ($przepis instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(EtapTableMap::COL_PRZEPIS_ID_PRZEPIS, $przepis->toKeyValue('PrimaryKey', 'IdPrzepis'), $comparison);
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
     * @return $this|ChildEtapQuery The current query, for fluid interface
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
     * @param   ChildEtap $etap Object to remove from the list of results
     *
     * @return $this|ChildEtapQuery The current query, for fluid interface
     */
    public function prune($etap = null)
    {
        if ($etap) {
            $this->addUsingAlias(EtapTableMap::COL_ID_ETAP, $etap->getIdEtap(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the etap table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EtapTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            EtapTableMap::clearInstancePool();
            EtapTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(EtapTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(EtapTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            EtapTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            EtapTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // EtapQuery
