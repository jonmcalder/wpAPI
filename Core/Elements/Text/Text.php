<?php

/**
 * Created by PhpStorm.
 * User: chidow
 * Date: 2016/08/13
 * Time: 7:46 PM
 */



class Text extends BaseElement
{

    function __construct($id, $label, $permissions=null, $elementPath='')
    {
        parent::__construct($id, $label, $permissions, $elementPath);
    }

    function ReadView($post_id)
    {
        echo $this->twigTemplate->render(get_class($this).'/read_view.mustache', ["value" => $this->GetDatabaseValue($post_id)]);
    }

    function EditView( $post)
    {
       parent::EditView($post);
       echo $this->twigTemplate->render(get_class($this).'/edit_view.mustache', [
           "id" => $this->id,
           "label" => $this->label,
           "value" => $this->GetDatabaseValue($post->ID)
       ]);
    }

    function ProcessPostData($post_id)
    {
        parent::ProcessPostData($post_id);
        $data = sanitize_text_field($_POST[$this->id]);

        $this->SaveElementData($post_id, $data);
        
    }
}