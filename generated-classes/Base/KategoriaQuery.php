<?php

namespace Base;

use \Kategoria as ChildKategoria;
use \KategoriaQuery as ChildKategoriaQuery;
use \Exception;
use \PDO;
use Map\KategoriaTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'kategoria' table.
 *
 *
 *
 * @method     ChildKategoriaQuery orderByNazwa($order = Criteria::ASC) Order by the nazwa column
 * @method     ChildKategoriaQuery orderByOpis($order = Criteria::ASC) Order by the opis column
 *
 * @method     ChildKategoriaQuery groupByNazwa() Group by the nazwa column
 * @method     ChildKategoriaQuery groupByOpis() Group by the opis column
 *
 * @method     ChildKategoriaQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildKategoriaQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildKategoriaQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildKategoriaQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildKategoriaQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildKategoriaQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildKategoriaQuery leftJoinNalezy($relationAlias = null) Adds a LEFT JOIN clause to the query using the Nalezy relation
 * @method     ChildKategoriaQuery rightJoinNalezy($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Nalezy relation
 * @method     ChildKategoriaQuery innerJoinNalezy($relationAlias = null) Adds a INNER JOIN clause to the query using the Nalezy relation
 *
 * @method     ChildKategoriaQuery joinWithNalezy($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Nalezy relation
 *
 * @method     ChildKategoriaQuery leftJoinWithNalezy() Adds a LEFT JOIN clause and with to the query using the Nalezy relation
 * @method     ChildKategoriaQuery rightJoinWithNalezy() Adds a RIGHT JOIN clause and with to the query using the Nalezy relation
 * @method     ChildKategoriaQuery innerJoinWithNalezy() Adds a INNER JOIN clause and with to the query using the Nalezy relation
 *
 * @method     \NalezyQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildKategoria|null findOne(ConnectionInterface $con = null) Return the first ChildKategoria matching the query
 * @method     ChildKategoria findOneOrCreate(ConnectionInterface $con = null) Return the first ChildKategoria matching the query, or a new ChildKategoria object populated from the query conditions when no match is found
 *
 * @method     ChildKategoria|null findOneByNazwa(string $nazwa) Return the first ChildKategoria filtered by the nazwa column
 * @method     ChildKategoria|null findOneByOpis(string $opis) Return the first ChildKategoria filtered by the opis column *

 * @method     ChildKategoria requirePk($key, ConnectionInterface $con = null) Return the ChildKategoria by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildKategoria requireOne(ConnectionInterface $con = null) Return the first ChildKategoria matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildKategoria requireOneByNazwa(string $nazwa) Return the first ChildKategoria filtered by the nazwa column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildKategoria requireOneByOpis(string $opis) Return the first ChildKategoria filtered by the opis column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildKategoria[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildKategoria objects based on current ModelCriteria
 * @method     ChildKategoria[]|ObjectCollection findByNazwa(string $nazwa) Return ChildKategoria objects filtered by the nazwa column
 * @method     ChildKategoria[]|ObjectCollection findByOpis(string $opis) Return ChildKategoria objects filtered by the opis column
 * @method     ChildKategoria[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class KategoriaQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\KategoriaQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'kulinaria', $modelName = '\\Kategoria', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildKategoriaQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildKategoriaQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildKategoriaQuery) {
            return $criteria;
        }
        $query = new ChildKategoriaQuery();
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
     * @return ChildKategoria|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(KategoriaTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = KategoriaTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildKategoria A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT nazwa, opis FROM kategoria WHERE nazwa = :p0';
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
            /** @var ChildKategoria $obj */
            $obj = new ChildKategoria();
            $obj->hydrate($row);
            KategoriaTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildKategoria|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildKategoriaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(KategoriaTableMap::COL_NAZWA, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildKategoriaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(KategoriaTableMap::COL_NAZWA, $keys, Criteria::IN);
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
     * @return $this|ChildKategoriaQuery The current query, for fluid interface
     */
    public function filterByNazwa($nazwa = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nazwa)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(KategoriaTableMap::COL_NAZWA, $nazwa, $comparison);
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
     * @return $this|ChildKategoriaQuery The current query, for fluid interface
     */
    public function filterByOpis($opis = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($opis)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(KategoriaTableMap::COL_OPIS, $opis, $comparison);
    }

    /**
     * Filter the query by a related \Nalezy object
     *
     * @param \Nalezy|ObjectCollection $nalezy the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildKategoriaQuery The current query, for fluid interface
     */
    public function filterByNalezy($nalezy, $comparison = null)
    {
        if ($nalezy instanceof \Nalezy) {
            return $this
                ->addUsingAlias(KategoriaTableMap::COL_NAZWA, $nalezy->getKategoriaNazwa(), $comparison);
        } elseif ($nalezy instanceof ObjectCollection) {
            return $this
                ->useNalezyQuery()
                ->filterByPrimaryKeys($nalezy->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByNalezy() only accepts arguments of type \Nalezy or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Nalezy relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildKategoriaQuery The current query, for fluid interface
     */
    public function joinNalezy($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Nalezy');

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
            $this->addJoinObject($join, 'Nalezy');
        }

        return $this;
    }

    /**
     * Use the Nalezy relation Nalezy object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \NalezyQuery A secondary query class using the current class as primary query
     */
    public function useNalezyQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinNalezy($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Nalezy', '\NalezyQuery');
    }

    /**
     * Use the Nalezy relation Nalezy object
     *
     * @param callable(\NalezyQuery):\NalezyQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withNalezyQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useNalezyQuery(
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
     * @param   ChildKategoria $kategoria Object to remove from the list of results
     *
     * @return $this|ChildKategoriaQuery The current query, for fluid interface
     */
    public function prune($kategoria = null)
    {
        if ($kategoria) {
            $this->addUsingAlias(KategoriaTableMap::COL_NAZWA, $kategoria->getNazwa(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the kategoria table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(KategoriaTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            KategoriaTableMap::clearInstancePool();
            KategoriaTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(KategoriaTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(KategoriaTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            KategoriaTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            KategoriaTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // KategoriaQuery
