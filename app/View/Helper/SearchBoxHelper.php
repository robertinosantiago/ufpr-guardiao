<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppHelper', 'View/Helper');

/**
 * Helper que permite a inclusão de uma caixa de pesquisa na listagem de registros
 *
 * @author Robertino Mendes Santiago Junior
 */
class SearchBoxHelper extends AppHelper {
    
    public $helpers = array('Html');

    /**
     * Cria uma caixa de pesquisa. 
     * @param array $action
     * @param string $query
     * @param boolean $activeClear
     * @return string
     */
    public function makeSearchBox($action = array(), $query = null, $activeClear = false) {
        $html = '<div class="searchbox">';
        $html .= '<form action="'. $this->Html->url($action). '" method="get" class=" well well-small">';
        $html .= '<div class="input-group">';
        $html .= '<input type="text" class="form-control" name="query" id="query" value="'. $query .'" placeholder="'. __('Search') . '">';
        $html .= '<span class="input-group-btn">';
        $html .= '<button type="submit" class="btn btn-primary">';
        $html .= '<i class="fa fa-search"></i>';
        $html .= '</button>';
        if ($activeClear):
            $html .= '<a href="'. $this->Html->url($action) . '" class="btn btn-default">';
            $html .= '<i class="fa fa-times-circle"></i>' . __('Clear');
            $html .= '</a>';
        endif;
        $html .= '</span>';
        $html .= '</div>';
        $html .= '</form>';
        $html .= '</div>';
        return $html;
    }
    
}
