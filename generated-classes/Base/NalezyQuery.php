<?php

namespace Base;

use \Nalezy as ChildNalezy;
use \NalezyQuery as ChildNalezyQuery;
use \Exception;
use \PDO;
use Map\NalezyTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'nalezy' table.
 *
 *
 *
 * @method     ChildNalezyQuery orderByPrzepisIdPrzepis($order = Criteria::ASC) Order by the PRZEPIS_id_przepis column
 * @method     ChildNalezyQuery orderByKategoriaNazwa($order = Criteria::ASC) Order by the KATEGORIA_nazwa column
 *
 * @method     ChildNalezyQuery groupByPrzepisIdPrzepis() Group by the PRZEPIS_id_przepis column
 * @method     ChildNalezyQuery groupByKategoriaNazwa() Group by the KATEGORIA_nazwa column
 *
 * @method     ChildNalezyQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildNalezyQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildNalezyQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildNalezyQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildNalezyQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildNalezyQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildNalezyQuery leftJoinPrzepis($relationAlias = null) Adds a LEFT JOIN clause to the query using the Przepis relation
 * @method     ChildNalezyQuery rightJoinPrzepis($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Przepis relation
 * @method     ChildNalezyQuery innerJoinPrzepis($relationAlias = null) Adds a INNER JOIN clause to the query using the Przepis relation
 *
 * @method     ChildNalezyQuery joinWithPrzepis($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Przepis relation
 *
 * @method     ChildNalezyQuery leftJoinWithPrzepis() Adds a LEFT JOIN clause and with to the query using the Przepis relation
 * @method     ChildNalezyQuery rightJoinWithPrzepis() Adds a RIGHT JOIN clause and with to the query using the Przepis relation
 * @method     ChildNalezyQuery innerJoinWithPrzepis() Adds a INNER JOIN clause and with to the query using the Przepis relation
 *
 * @method     ChildNalezyQuery leftJoinKategoria($relationAlias = null) Adds a LEFT JOIN clause to the query using the Kategoria relation
 * @method     ChildNalezyQuery rightJoinKategoria($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Kategoria relation
 * @method     ChildNalezyQuery innerJoinKategoria($relationAlias = null) Adds a INNER JOIN clause to the query using the Kategoria relation
 *
 * @method     ChildNalezyQuery joinWithKategoria($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Kategoria relation
 *
 * @method     ChildNalezyQuery leftJoinWithKategoria() Adds a LEFT JOIN clause and with to the query using the Kategoria relation
 * @method     ChildNalezyQuery rightJoinWithKategoria() Adds a RIGHT JOIN clause and with to the query using the Kategoria relation
 * @method     ChildNalezyQuery innerJoinWithKategoria() Adds a INNER JOIN clause and with to the query using the Kategoria relation
 *
 * @method     \PrzepisQuery|\KategoriaQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildNalezy|null findOne(ConnectionInterface $con = null) Return the first ChildNalezy matching the query
 * @method     ChildNalezy findOneOrCreate(ConnectionInterface $con = null) Return the first ChildNalezy matching the query, or a new ChildNalezy object populated from the query conditions when no match is found
 *
 * @method     ChildNalezy|null findOneByPrzepisIdPrzepis(int $PRZEPIS_id_przepis) Return the first ChildNalezy filtered by the PRZEPIS_id_przepis column
 * @method     ChildNalezy|null findOneByKategoriaNazwa(string $KATEGORIA_nazwa) Return the first ChildNalezy filtered by the KATEGORIA_nazwa column *

 * @method     ChildNalezy requirePk($key, ConnectionInterface $con = null) Return the ChildNalezy by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNalezy requireOne(ConnectionInterface $con = null) Return the first ChildNalezy matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildNalezy requireOneByPrzepisIdPrzepis(int $PRZEPIS_id_przepis) Return the first ChildNalezy filtered by the PRZEPIS_id_przepis column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNalezy requireOneByKategoriaNazwa(string $KATEGORIA_nazwa) Return the first ChildNalezy filtered by the KATEGORIA_nazwa column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildNalezy[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildNalezy objects based on current ModelCriteria
 * @method     ChildNalezy[]|ObjectCollection findByPrzepisIdPrzepis(int $PRZEPIS_id_przepis) Return ChildNalezy objects filtered by the PRZEPIS_id_przepis column
 * @method     ChildNalezy[]|ObjectCollection findByKategoriaNazwa(string $KATEGORIA_nazwa) Return ChildNalezy objects filtered by the KATEGORIA_nazwa column
 * @method     ChildNalezy[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class NalezyQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\NalezyQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'kulinaria', $modelName = '\\Nalezy', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildNalezyQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildNalezyQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildNalezyQuery) {
            return $criteria;
        }
        $query = new ChildNalezyQuery();
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
     * @param array[$PRZEPIS_id_przepis, $KATEGORIA_nazwa] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildNalezy|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(NalezyTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = NalezyTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildNalezy A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT PRZEPIS_id_przepis, KATEGORIA_nazwa FROM nalezy WHERE PRZEPIS_id_przepis = :p0 AND KATEGORIA_nazwa = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildNalezy $obj */
            $obj = new ChildNalezy();
            $obj->hydrate($row);
            NalezyTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildNalezy|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildNalezyQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(NalezyTableMap::COL_PRZEPIS_ID_PRZEPIS, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(NalezyTableMap::COL_KATEGORIA_NAZWA, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildNalezyQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(NalezyTableMap::COL_PRZEPIS_ID_PRZEPIS, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(NalezyTableMap::COL_KATEGORIA_NAZWA, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
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
     * @return $this|ChildNalezyQuery The current query, for fluid interface
     */
    public function filterByPrzepisIdPrzepis($przepisIdPrzepis = null, $comparison = null)
    {
        if (is_array($przepisIdPrzepis)) {
            $useMinMax = false;
            if (isset($przepisIdPrzepis['min'])) {
                $this->addUsingAlias(NalezyTableMap::COL_PRZEPIS_ID_PRZEPIS, $przepisIdPrzepis['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($przepisIdPrzepis['max'])) {
                $this->addUsingAlias(NalezyTableMap::COL_PRZEPIS_ID_PRZEPIS, $przepisIdPrzepis['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NalezyTableMap::COL_PRZEPIS_ID_PRZEPIS, $przepisIdPrzepis, $comparison);
    }

    /**
     * Filter the query on the KATEGORIA_nazwa column
     *
     * Example usage:
     * <code>
     * $query->filterByKategoriaNazwa('fooValue');   // WHERE KATEGORIA_nazwa = 'fooValue'
     * $query->filterByKategoriaNazwa('%fooValue%', Criteria::LIKE); // WHERE KATEGORIA_nazwa LIKE '%fooValue%'
     * </code>
     *
     * @param     string $kategoriaNazwa The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildNalezyQuery The current query, for fluid interface
     */
    public function filterByKategoriaNazwa($kategoriaNazwa = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($kategoriaNazwa)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NalezyTableMap::COL_KATEGORIA_NAZWA, $kategoriaNazwa, $comparison);
    }

    /**
     * Filter the query by a related \Przepis object
     *
     * @param \Przepis|ObjectCollection $przepis The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildNalezyQuery The current query, for fluid interface
     */
    public function filterByPrzepis($przepis, $comparison = null)
    {
        if ($przepis instanceof \Przepis) {
            return $this
                ->addUsingAlias(NalezyTableMap::COL_PRZEPIS_ID_PRZEPIS, $przepis->getIdPrzepis(), $comparison);
        } elseif ($przepis instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(NalezyTableMap::COL_PRZEPIS_ID_PRZEPIS, $przepis->toKeyValue('PrimaryKey', 'IdPrzepis'), $comparison);
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
     * @return $this|ChildNalezyQuery The current query, for fluid interface
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
     * Filter the query by a related \Kategoria object
     *
     * @param \Kategoria|ObjectCollection $kategoria The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildNalezyQuery The current query, for fluid interface
     */
    public function filterByKategoria($kategoria, $comparison = null)
    {
        if ($kategoria instanceof \Kategoria) {
            return $this
                ->addUsingAlias(NalezyTableMap::COL_KATEGORIA_NAZWA, $kategoria->getNazwa(), $comparison);
        } elseif ($kategoria instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(NalezyTableMap::COL_KATEGORIA_NAZWA, $kategoria->toKeyValue('PrimaryKey', 'Nazwa'), $comparison);
        } else {
            throw new PropelException('filterByKategoria() only accepts arguments of type \Kategoria or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Kategoria relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildNalezyQuery The current query, for fluid interface
     */
    public function joinKategoria($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Kategoria');

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
            $this->addJoinObject($join, 'Kategoria');
        }

        return $this;
    }

    /**
     * Use the Kategoria relation Kategoria object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \KategoriaQuery A secondary query class using the current class as primary query
     */
    public function useKategoriaQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinKategoria($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Kategoria', '\KategoriaQuery');
    }

    /**
     * Use the Kategoria relation Kategoria object
     *
     * @param callable(\KategoriaQuery):\KategoriaQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withKategoriaQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useKategoriaQuery(
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
     * @param   ChildNalezy $nalezy Object to remove from the list of results
     *
     * @return $this|ChildNalezyQuery The current query, for fluid interface
     */
    public function prune($nalezy = null)
    {
        if ($nalezy) {
            $this->addCond('pruneCond0', $this->getAliasedColName(NalezyTableMap::COL_PRZEPIS_ID_PRZEPIS), $nalezy->getPrzepisIdPrzepis(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(NalezyTableMap::COL_KATEGORIA_NAZWA), $nalezy->getKategoriaNazwa(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the nalezy table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(NalezyTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            NalezyTableMap::clearInstancePool();
            NalezyTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(NalezyTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(NalezyTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            NalezyTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            NalezyTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // NalezyQuery
