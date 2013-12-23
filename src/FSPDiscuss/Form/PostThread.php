<?php

namespace FspDiscuss\Form;

use Zend\Form\Form;

class PostThread extends Form
{
    public function __construct()
    {
        parent::__construct();

        $this->add(array(
                'name' => 'subject',
                'options' => array(
                        'label' => 'Subject',
                ),
                'attributes' => array(
                        'type' => 'text',
                ),
        ));

        $this->add(array(
                'name' => 'slug',
                'options' => array(
                        'label' => 'Slug',
                ),
                'attributes' => array(
                        'type' => 'text',
                ),
        ));

        // Submit button.
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Post',
                'id'    => 'submitbutton',
                'class' => 'btn btn-primary'
            ),
        ));
    }
}
