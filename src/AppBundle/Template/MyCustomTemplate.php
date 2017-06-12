<?php

namespace AppBundle\Template;

use Pagerfanta\View\Template\DefaultTemplate;

class MyCustomTemplate extends DefaultTemplate
{
    static protected $defaultOptions = array(
        'previous_message' => 'Назад',
        'next_message' => 'Вперед',
        'css_disabled_class' => 'disabled',
        'css_dots_class' => '',
        'css_current_class' => 'pagination-item-active',
        'css_prev_class' => 'pagination-item-prev',
        'css_next_class' => 'pagination-item-next',
        'dots_text' => '',
        'container_template' => '<ul class="pagination-list">%pages%</ul>',
        'page_template' => '<li class="pagination-item %class% %sub_class%"><a href="%href%"%rel%>%text%</a></li>',
        'span_template' => '<li class="pagination-item %class% %sub_class%"><span>%text%</span></li>',
        'rel_previous' => 'prev',
        'rel_next' => 'next'
    );

    public function previousDisabled()
    {
        return $this->generatePrevious(parent::previousDisabled());
    }

    public function previousEnabled($page)
    {
        return $this->generatePrevious(parent::previousEnabled($page));
    }

    public function nextDisabled()
    {
        return $this->generateNext(parent::nextDisabled());
    }

    public function nextEnabled($page)
    {
        return $this->generateNext(parent::nextEnabled($page));
    }


    private function generatePrevious($node)
    {
        return $this->generatePreviousNext($node, $this->option('css_prev_class'));
    }

    private function generateNext($node)
    {
        return $this->generatePreviousNext($node, $this->option('css_next_class'));
    }

    private function generatePreviousNext($node, $class)
    {
        $search = ['%sub_class%'];

        $replace = [$class];

        return str_replace($search, $replace, $node);
    }
}
