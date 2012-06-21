<?php

namespace Deuteron\Bundle\PaginationBundle\Twig\Extension;

class PaginationExtension extends \Twig_Extension
{
    /**
     * @var \Twig_Environment
     */
    private $twig;

    /**
     * @var string
     */
    private $template;

  /**
   * @param \Twig_Environment $twig
   * @param string $template
   */
    public function __construct(\Twig_Environment $twig, $template)
    {
        $this->twig = $twig;
        $this->template = $template;
    }

    public function getFunctions()
    {
        return array(
            'deuteron_pagination_render' => new \Twig_Function_Method($this, 'render', array('is_safe' => array('html'))),
        );
    }

    /**
     * Renders the post list.
     *
     * @param \PropelModelPager $paginator
     * @param array $options
     * @throws \InvalidArgumentException
     * @return string
     */
    public function render(\PropelModelPager $paginator, $options = array())
    {
        $paginationUrlParameters = (false === isset($options['paginationUrlParameters'])) ? array() : $options['paginationUrlParameters'];
        if(false === is_array($paginationUrlParameters))
        {
            throw new \InvalidArgumentException('The parameters for the pagination url must be an array.');
        }

        $paginationLabel['firstLinkLabel'] = (false === isset($options['firstLinkLabel'])) ? 'Première' : $options['firstLinkLabel'];
        $paginationLabel['previousLinkLabel'] = (false === isset($options['previousLinkLabel'])) ? 'Précédente' : $options['previousLinkLabel'];
        $paginationLabel['nextLinkLabel'] = (false === isset($options['nextLinkLabel'])) ? 'Suivante' : $options['nextLinkLabel'];
        $paginationLabel['lastLinkLabel'] = (false === isset($options['lastLinkLabel'])) ? 'Dernière' : $options['lastLinkLabel'];

        $displayFirstLinks  = (false === isset($options['displayFirstLinks'])) ? true : $options['displayFirstLinks'];
        $displayLastLinks   = (false === isset($options['displayLastLinks'])) ? true : $options['displayLastLinks'];

        $templateContent = $this->twig->loadTemplate($this->template);

        return $templateContent->render(array(
            'paginator'         => $paginator,
            'url'               => (false === isset($options['paginationUrl'])) ? 'index_page' : $options['paginationUrl'],
            'urlParameters'     => $paginationUrlParameters,
            'label'             => $paginationLabel,
            'displayFirstLinks' => $displayFirstLinks,
            'displayLastLinks'  => $displayLastLinks,
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'deuteron_pagination';
    }
}
