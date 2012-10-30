<?php


/**
 * Base class that represents a query for the 'currency' table.
 *
 * 
 *
 * @method     CurrencyQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     CurrencyQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     CurrencyQuery orderByIsoCode($order = Criteria::ASC) Order by the iso_code column
 * @method     CurrencyQuery orderByIsoNumber($order = Criteria::ASC) Order by the iso_number column
 *
 * @method     CurrencyQuery groupById() Group by the id column
 * @method     CurrencyQuery groupByName() Group by the name column
 * @method     CurrencyQuery groupByIsoCode() Group by the iso_code column
 * @method     CurrencyQuery groupByIsoNumber() Group by the iso_number column
 *
 * @method     CurrencyQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     CurrencyQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     CurrencyQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     CurrencyQuery leftJoinCountry($relationAlias = null) Adds a LEFT JOIN clause to the query using the Country relation
 * @method     CurrencyQuery rightJoinCountry($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Country relation
 * @method     CurrencyQuery innerJoinCountry($relationAlias = null) Adds a INNER JOIN clause to the query using the Country relation
 *
 * @method     Currency findOne(PropelPDO $con = null) Return the first Currency matching the query
 * @method     Currency findOneOrCreate(PropelPDO $con = null) Return the first Currency matching the query, or a new Currency object populated from the query conditions when no match is found
 *
 * @method     Currency findOneById(int $id) Return the first Currency filtered by the id column
 * @method     Currency findOneByName(string $name) Return the first Currency filtered by the name column
 * @method     Currency findOneByIsoCode(string $iso_code) Return the first Currency filtered by the iso_code column
 * @method     Currency findOneByIsoNumber(string $iso_number) Return the first Currency filtered by the iso_number column
 *
 * @method     array findById(int $id) Return Currency objects filtered by the id column
 * @method     array findByName(string $name) Return Currency objects filtered by the name column
 * @method     array findByIsoCode(string $iso_code) Return Currency objects filtered by the iso_code column
 * @method     array findByIsoNumber(string $iso_number) Return Currency objects filtered by the iso_number column
 *
 * @package    propel.generator.lib.model.om
 */
abstract class BaseCurrencyQuery extends ModelCriteria
{
    
    /**
     * Initializes internal state of BaseCurrencyQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'propel', $modelName = 'Currency', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new CurrencyQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return    CurrencyQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof CurrencyQuery) {
            return $criteria;
        }
        $query = new CurrencyQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }
        return $query;
    }

    /**
     * Find object by primary key
     * Use instance pooling to avoid a database query if the object exists
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return    Currency|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ((null !== ($obj = CurrencyPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
            // the object is alredy in the instance pool
            return $obj;
        } else {
            // the object has not been requested yet, or the formatter is not an object formatter
            $criteria = $this->isKeepQuery() ? clone $this : $this;
            $stmt = $criteria
                ->filterByPrimaryKey($key)
                ->getSelectStatement($con);
            return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
        }
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return    PropelObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        return $this
            ->filterByPrimaryKeys($keys)
            ->find($con);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return    CurrencyQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        return $this->addUsingAlias(CurrencyPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return    CurrencyQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        return $this->addUsingAlias(CurrencyPeer::ID, $keys, Criteria::IN);
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
     * @return    CurrencyQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }
        return $this->addUsingAlias(CurrencyPeer::ID, $id, $comparison);
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
     * @return    CurrencyQuery The current query, for fluid interface
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
        return $this->addUsingAlias(CurrencyPeer::NAME, $name, $comparison);
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
     * @return    CurrencyQuery The current query, for fluid interface
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
        return $this->addUsingAlias(CurrencyPeer::ISO_CODE, $isoCode, $comparison);
    }

    /**
     * Filter the query on the iso_number column
     *
     * Example usage:
     * <code>
     * $query->filterByIsoNumber('fooValue');   // WHERE iso_number = 'fooValue'
     * $query->filterByIsoNumber('%fooValue%'); // WHERE iso_number LIKE '%fooValue%'
     * </code>
     *
     * @param     string $isoNumber The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return    CurrencyQuery The current query, for fluid interface
     */
    public function filterByIsoNumber($isoNumber = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($isoNumber)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $isoNumber)) {
                $isoNumber = str_replace('*', '%', $isoNumber);
                $comparison = Criteria::LIKE;
            }
        }
        return $this->addUsingAlias(CurrencyPeer::ISO_NUMBER, $isoNumber, $comparison);
    }

    /**
     * Filter the query by a related Country object
     *
     * @param     Country $country  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return    CurrencyQuery The current query, for fluid interface
     */
    public function filterByCountry($country, $comparison = null)
    {
        if ($country instanceof Country) {
            return $this
                ->addUsingAlias(CurrencyPeer::ID, $country->getDefaultCurrencyId(), $comparison);
        } elseif ($country instanceof PropelCollection) {
            return $this
                ->useCountryQuery()
                ->filterByPrimaryKeys($country->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByCountry() only accepts arguments of type Country or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Country relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return    CurrencyQuery The current query, for fluid interface
     */
    public function joinCountry($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Country');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Country');
        }

        return $this;
    }

    /**
     * Use the Country relation Country object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return    CountryQuery A secondary query class using the current class as primary query
     */
    public function useCountryQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinCountry($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Country', 'CountryQuery');
    }

    /**
     * Exclude object from result
     *
     * @param     Currency $currency Object to remove from the list of results
     *
     * @return    CurrencyQuery The current query, for fluid interface
     */
    public function prune($currency = null)
    {
        if ($currency) {
            $this->addUsingAlias(CurrencyPeer::ID, $currency->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

} // BaseCurrencyQuery