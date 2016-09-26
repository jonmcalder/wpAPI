<?php

/**
 * Created by PhpStorm.
 * User: chidow
 * Date: 2016/09/26
 * Time: 11:15 PM
 */
class wpQueryObject
{

    private $queryArgs = [];
    private $postType;

    function __construct($postType)
    {
        $this->postType = $postType;
    }

    #TODO and column logic
    public function Select($colums = [])
    {
        $this->queryArgs["post_type"] =  $this->postType->GetSlug();

        return $this;
    }

    public function OrderBy($fieldname, $asc_desc)
    {
        #TODO: What if not meta Value
        $this->queryArgs["orderby"] =  "meta_value";
        $this->queryArgs["meta_key"] =  $fieldname;
        $this->queryArgs["order"] =  $asc_desc; # ASC or DESC
        return $this;

    }

    public function Fetch()
    {
        $loop = new WP_Query( $this->queryArgs );

        while ( $loop->have_posts() ) : $loop->the_post();

            $returnRow = [];

            foreach ($this->postType->GetFields() as $field)
            {
                #TODO: if not custom post
                $returnRow[$field->id] = post_custom($field->valueKey);
            }
            yield  $returnRow;

        endwhile;
    }
}