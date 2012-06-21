<?php

namespace Admingenerated\DeuteronUserBundle\BaseUserController;

use Deuteron\Bundle\UserBundle\Form\Type\User\FiltersType;


use Admingenerator\GeneratorBundle\Controller\Propel\BaseController as BaseController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\PropelAdapter as PagerAdapter;

class ListController extends BaseController
{
    public function indexAction()
    {
        

        if ($this->get('request')->query->get('page'))
        {
          $this->setPage($this->get('request')->query->get('page'));
        }

        if ($this->get('request')->query->get('sort'))
        {
          $this->setSort($this->get('request')->query->get('sort'), $this->get('request')->query->get('order_by','ASC'));
        }

        $form = $this->getFilterForm();

        return $this->render('DeuteronUserBundle:UserList:index.html.twig', array(
            'Users' => $this->getPager(),
            'form'                      => $form->createView(),
            'sortColumn'                => $this->getSortColumn(),
            'sortOrder'                 => $this->getSortOrder(),
            'scopes'                    => $this->getScopes(),
        ));
    }
    /**
     * Store in the session service the current page
     *
     * @param integer $page The page number
     */
    protected function setPage($page)
    {
        $this->get('session')->set('Deuteron\UserBundle\UserList\Page', $page);
    }

    /**
     * Return the stored page
     *
     * @return integer $page The page number
     */
    protected function getPage()
    {
        return $this->get('session')->get('Deuteron\UserBundle\UserList\Page', 1);
    }

    protected function getPager()
    {
        $paginator = new Pagerfanta(new PagerAdapter($this->getQuery()));
        $paginator->setMaxPerPage(10);
        $paginator->setCurrentPage($this->getPage(), false, true);

        return $paginator;
    }
    /**
     * Store in the session service the current sort
     *
     * @param string $column The column
     * @param string $order_by The order sorting (ASC,DESC)
     */
    protected function setSort($column, $order_by)
    {
        $this->get('session')->set('Deuteron\UserBundle\UserList\Sort', $column);

        if ($order_by == 'desc') {
            $this->get('session')->set('Deuteron\UserBundle\UserList\OrderBy', 'DESC');
        } else {
             $this->get('session')->set('Deuteron\UserBundle\UserList\OrderBy', 'ASC');
        }
    }

    /**
     * Return the stored sort
     *
     * @return string The column to sort
     */
    protected function getSortColumn()
    {
        return $this->get('session')->get('Deuteron\UserBundle\UserList\Sort');
        }

    /**
     * Return the stored sort order
     *
     * @return string the order mode ASC|DESC
     */
    protected function getSortOrder()
    {
        return $this->get('session')->get('Deuteron\UserBundle\UserList\OrderBy', 'ASC');
        }

    public function filtersAction()
    {
        if ($this->get('request')->get('reset')) {
            $this->setFilters(array());

            return new RedirectResponse($this->generateUrl("Deuteron_Bundle_UserBundle_User_list"));
        }

        if ($this->getRequest()->getMethod() == "POST") {
            $form = $this->getFilterForm();
            $form->bindRequest($this->get('request'));

            if ($form->isValid()) {
                $filters = $form->getClientData();
            }
        }

        if ($this->getRequest()->getMethod() == "GET") {
            $filters = $this->getRequest()->query->all();
        }

        $this->setFilters($filters);

        return new RedirectResponse($this->generateUrl("Deuteron_Bundle_UserBundle_User_list"));
    }

    protected function setFilters($filters)
    {
        $this->get('session')->set('Deuteron\UserBundle\UserList\Filters', $filters);
    }
    
    protected function getFilters()
    {
        return $this->get('session')->get('Deuteron\UserBundle\UserList\Filters', array());
    }
        public function scopesAction()
    {
        if ($this->get('request')->get('reset')) {
            $this->setScopes(array());

            return new RedirectResponse($this->generateUrl("Deuteron_Bundle_UserBundle_User_list"));
        }

        $this->setScope($this->get('request')->get('group'), $this->get('request')->get('scope'));

        return new RedirectResponse($this->generateUrl("Deuteron_Bundle_UserBundle_User_list"));
    }

    /**
     * Store in the session service the current scopes
     *
     * @param array the scopes
     */
    protected function setScopes($scopes)
    {
        $this->get('session')->set('Deuteron\UserBundle\UserList\Scopes', $scopes);
    }

    /**
    * Change the value of one Scope
    *
    * @param string the group name
    * @param string the scope name
    */
    protected function setScope($groupName, $scopeName)
    {
        $scopes = $this->getScopes();
        $scopes[$groupName] = $scopeName;
        $this->setScopes($scopes);
    }

    protected function getScopes()
    {
        return $this->get('session')->get('Deuteron\UserBundle\UserList\Scopes', $this->getDefaultScopes());
    }

    protected function getDefaultScopes()
    {
        $scopes = array();

        
        return $scopes;
    }

    /*
    * @return string|null the scope setted for the current group
    */
    protected function getScope($groupName)
    {
        $scopes = $this->getScopes();

        return isset($scopes[$groupName]) ? $scopes[$groupName] : null ;
    }


    protected function getQuery()
    {
        $query = \FOS\UserBundle\Propel\UserQuery::create();

        $this->processSort($query);
        $this->processFilters($query);
        
        return $query;
    }

    protected function processSort($query)
    {
        if ($this->getSortColumn()) {
            if (!strstr($this->getSortColumn(), '.')) { //direct column
                $query->orderBy($this->getSortColumn(), $this->getSortOrder());
            } else {
                list($table, $column) = explode('.', $this->getSortColumn(), 2);
                $this->addJoinFor($table, $query);
                $query->orderBy($this->getSortColumn(), $this->getSortOrder());
            }
        }
    }

    protected function getFilterForm()
    {
        $filters = $this->getFilters();

        return $this->createForm($this->getFiltersType(), $this->getFilters());
    }

    protected function addJoinFor($table, $query)
    {
        $query->leftJoin($table);
    }

    protected function processFilters($query)
    {
        $filterObject = $this->getFilters();

        $queryFilter = $this->get('admingenerator.queryfilter.propel');
        $queryFilter->setQuery($query);

        
        if (isset($filterObject['username']) && null !== $filterObject['username']) {
            $queryFilter->addVarcharFilter("username", $filterObject['username']);
        }
        
        if (isset($filterObject['email']) && null !== $filterObject['email']) {
            $queryFilter->addVarcharFilter("email", $filterObject['email']);
        }
        
    }

    
    public function batchAction()
{
    if (!$this->get('request')->get('action') || !$this->get('request')->get('ids')) {
        return new RedirectResponse($this->generateUrl("Deuteron_Bundle_UserBundle_User_list"));
    }

    $method = 'doBatch'.ucfirst($this->get('request')->get('action'));
    $this->$method($this->get('request')->get('ids'));

    return new RedirectResponse($this->generateUrl("Deuteron_Bundle_UserBundle_User_list"));
}


    protected function doBatchDelete(array $ids)
    {
        if (\FOS\UserBundle\Propel\UserQuery::create()
            ->filterByPrimaryKeys($ids)
            ->delete()) {
            $this->get('session')->setFlash('success', $this->get('translator')->trans("batch.deleted.success", array(), 'Admingenerator') );
        } else {
            $this->get('session')->setFlash('error', $this->get('translator')->trans("batch.deleted.error", array(), 'Admingenerator') );
        }
    }

    protected function getFiltersType()
    {
        $type = new FiltersType();
        $type->setSecurityContext($this->get('security.context'));

        return $type;
    }
}
