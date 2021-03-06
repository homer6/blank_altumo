<?php


/**
 * Base class that represents a query for the 'country' table.
 *
 * 
 *
 * @method     CountryQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     CountryQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     CountryQuery orderByIsoCode($order = Criteria::ASC) Order by the iso_code column
 * @method     CountryQuery orderByIsoShortCode($order = Criteria::ASC) Order by the iso_short_code column
 * @method     CountryQuery orderByDemonym($order = Criteria::ASC) Order by the demonym column
 * @method     CountryQuery orderByDefaultCurrencyId($order = Criteria::ASC) Order by the default_currency_id column
 *
 * @method     CountryQuery groupById() Group by the id column
 * @method     CountryQuery groupByName() Group by the name column
 * @method     CountryQuery groupByIsoCode() Group by the iso_code column
 * @method     CountryQuery groupByIsoShortCode() Group by the iso_short_code column
 * @method     CountryQuery groupByDemonym() Group by the demonym column
 * @method     CountryQuery groupByDefaultCurrencyId() Group by the default_currency_id column
 *
 * @method     CountryQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     CountryQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     CountryQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     CountryQuery leftJoinCurrency($relationAlias = null) Adds a LEFT JOIN clause to the query using the Currency relation
 * @method     CountryQuery rightJoinCurrency($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Currency relation
 * @method     CountryQuery innerJoinCurrency($relationAlias = null) Adds a INNER JOIN clause to the query using the Currency relation
 *
 * @method     CountryQuery leftJoinState($relationAlias = null) Adds a LEFT JOIN clause to the query using the State relation
 * @method     CountryQuery rightJoinState($relationAlias = null) Adds a RIGHT JOIN clause to the query using the State relation
 * @method     CountryQuery innerJoinState($relationAlias = null) Adds a INNER JOIN clause to the query using the State relation
 *
 * @method     Country findOne(PropelPDO $con = null) Return the first Country matching the query
 * @method     Country findOneOrCreate(PropelPDO $con = null) Return the first Country matching the query, or a new Country object populated from the query conditions when no match is found
 *
 * @method     Country findOneById(int $id) Return the first Country filtered by the id column
 * @method     Country findOneByName(string $name) Return the first Country filtered by the name column
 * @method     Country findOneByIsoCode(string $iso_code) Return the first Country filtered by the iso_code column
 * @method     Country findOneByIsoShortCode(string $iso_short_code) Return the first Country filtered by the iso_short_code column
 * @method     Country findOneByDemonym(string $demonym) Return the first Country filtered by the demonym column
 * @method     Country findOneByDefaultCurrencyId(int $default_currency_id) Return the first Country filtered by the default_currency_id column
 *
 * @method     array findById(int $id) Return Country objects filtered by the id column
 * @method     array findByName(string $name) Return Country objects filtered by the name column
 * @method     array findByIsoCode(string $iso_code) Return Country objects filtered by the iso_code column
 * @method     array findByIsoShortCode(string $iso_short_code) Return Country objects filtered by the iso_short_code column
 * @method     array findByDemonym(string $demonym) Return Country objects filtered by the demonym column
 * @method     array findByDefaultCurrencyId(int $default_currency_id) Return Country objects filtered by the default_currency_id column
 *
 * @package    propel.generator.lib.model.om
 */
abstract class BaseCountryQuery extends ModelCriteria
{
    
    /**
     * Initializes internal state of BaseCountryQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'propel', $modelName = 'Country', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new CountryQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     CountryQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return CountryQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof CountryQuery) {
            return $criteria;
        }
        $query = new CountryQuery();
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
     * @param     PropelPDO $con an optional connection object
     *
     * @return   Country|Country[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = CountryPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(CountryPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return   Country A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `ID`, `NAME`, `ISO_CODE`, `ISO_SHORT_CODE`, `DEMONYM`, `DEFAULT_CURRENCY_ID` FROM `country` WHERE `ID` = :p0';
        try {
            $stmt = $con->prepare($sql);
			$stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new Country();
            $obj->hydrate($row);
            CountryPeer::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return Country|Country[]|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|Country[]|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection($this->getDbName(), Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($stmt);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return CountryQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CountryPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return CountryQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CountryPeer::ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CountryQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(CountryPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%'); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CountryQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $name)) {
                $name = str_replace('*', '%', $name);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CountryPeer::NAME, $name, $comparison);
    }

    /**
     * Filter the query on the iso_code column
     *
     * Example usage:
     * <code>
     * $query->filterByIsoCode('fooValue');   // WHERE iso_code = 'fooValue'
     * $query->filterByIsoCode('%fooValue%'); // WHERE iso_code LIKE '%fooValue%'
     * </code>
     *
     * @param     string $isoCode The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CountryQuery The current query, for fluid interface
     */
    public function filterByIsoCode($isoCode = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($isoCode)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $isoCode)) {
                $isoCode = str_replace('*', '%', $isoCode);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CountryPeer::ISO_CODE, $isoCode, $comparison);
    }

    /**
     * Filter the query on the iso_short_code column
     *
     * Example usage:
     * <code>
     * $query->filterByIsoShortCode('fooValue');   // WHERE iso_short_code = 'fooValue'
     * $query->filterByIsoShortCode('%fooValue%'); // WHERE iso_short_code LIKE '%fooValue%'
     * </code>
     *
     * @param     string $isoShortCode The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CountryQuery The current query, for fluid interface
     */
    public function filterByIsoShortCode($isoShortCode = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($isoShortCode)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $isoShortCode)) {
                $isoShortCode = str_replace('*', '%', $isoShortCode);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CountryPeer::ISO_SHORT_CODE, $isoShortCode, $comparison);
    }

    /**
     * Filter the query on the demonym column
     *
     * Example usage:
     * <code>
     * $query->filterByDemonym('fooValue');   // WHERE demonym = 'fooValue'
     * $query->filterByDemonym('%fooValue%'); // WHERE demonym LIKE '%fooValue%'
     * </code>
     *
     * @param     string $demonym The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CountryQuery The current query, for fluid interface
     */
    public function filterByDemonym($demonym = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($demonym)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $demonym)) {
                $demonym = str_replace('*', '%', $demonym);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CountryPeer::DEMONYM, $demonym, $comparison);
    }

    /**
     * Filter the query on the default_currency_id column
     *
     * Example usage:
     * <code>
     * $query->filterByDefaultCurrencyId(1234); // WHERE default_currency_id = 1234
     * $query->filterByDefaultCurrencyId(array(12, 34)); // WHERE default_currency_id IN (12, 34)
     * $query->filterByDefaultCurrencyId(array('min' => 12)); // WHERE default_currency_id > 12
     * </code>
     *
     * @see       filterByCurrency()
     *
     * @param     mixed $defaultCurrencyId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CountryQuery The current query, for fluid interface
     */
    public function filterByDefaultCurrencyId($defaultCurrencyId = null, $comparison = null)
    {
        if (is_array($defaultCurrencyId)) {
            $useMinMax = false;
            if (isset($defaultCurrencyId['min'])) {
                $this->addUsingAlias(CountryPeer::DEFAULT_CURRENCY_ID, $defaultCurrencyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($defaultCurrencyId['max'])) {
                $this->addUsingAlias(CountryPeer::DEFAULT_CURRENCY_ID, $defaultCurrencyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CountryPeer::DEFAULT_CURRENCY_ID, $defaultCurrencyId, $comparison);
    }

    /**
     * Filter the query by a related Currency object
     *
     * @param   Currency|PropelObjectCollection $currency The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   CountryQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByCurrency($currency, $comparison = null)
    {
        if ($currency instanceof Currency) {
            return $this
                ->addUsingAlias(CountryPeer::DEFAULT_CURRENCY_ID, $currency->getId(), $comparison);
        } elseif ($currency instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CountryPeer::DEFAULT_CURRENCY_ID, $currency->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByCurrency() only accepts arguments of type Currency or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Currency relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return CountryQuery The current query, for fluid interface
     */
    public function joinCurrency($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Currency');

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
            $this->addJoinObject($join, 'Currency');
        }

        return $this;
    }

    /**
     * Use the Currency relation Currency object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   CurrencyQuery A secondary query class using the current class as primary query
     */
    public function useCurrencyQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinCurrency($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Currency', 'CurrencyQuery');
    }

    /**
     * Filter the query by a related State object
     *
     * @param   State|PropelObjectCollection $state  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   CountryQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByState($state, $comparison = null)
    {
        if ($state instanceof State) {
            return $this
                ->addUsingAlias(CountryPeer::ID, $state->getCountryId(), $comparison);
        } elseif ($state instanceof PropelObjectCollection) {
            return $this
                ->useStateQuery()
                ->filterByPrimaryKeys($state->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByState() only accepts arguments of type State or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the State relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return CountryQuery The current query, for fluid interface
     */
    public function joinState($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('State');

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
            $this->addJoinObject($join, 'State');
        }

        return $this;
    }

    /**
     * Use the State relation State object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   StateQuery A secondary query class using the current class as primary query
     */
    public function useStateQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinState($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'State', 'StateQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Country $country Object to remove from the list of results
     *
     * @return CountryQuery The current query, for fluid interface
     */
    public function prune($country = null)
    {
        if ($country) {
            $this->addUsingAlias(CountryPeer::ID, $country->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

} // BaseCountryQuery