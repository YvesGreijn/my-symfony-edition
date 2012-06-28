<?php

namespace Deuteron\Bundle\AdminBundle\Menu\Renderer;

use Knp\Menu\ItemInterface;

class Side
{
    public function __construct()
    {
    }

    /**
     * Renders a menu with the specified renderer.
     *
     * @param ItemInterface $item
     * @param array $options
     * @return string
     */
    public function render(ItemInterface $item, array $options = array())
    {
        $options = array_merge($this->defaultOptions, $options);

        $template = $options['template'];
        if (!$template instanceof \Twig_Template) {
            $template = $this->environment->loadTemplate($template);
        }

        $block = $options['compressed'] ? 'compressed_root' : 'root';

        $html = $template->renderBlock($block, array('item' => $item, 'options' => $options, 'matcher' => $this->matcher));

        if ($options['clear_matcher']) {
            $this->matcher->clear();
        }

        return $html;
    }
}
