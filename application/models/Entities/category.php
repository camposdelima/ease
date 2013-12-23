<?php

namespace Entities;

/**
 * @Entity
 * @Table(name="categorias")
 */
class Category extends \Entities\MY_Entity
{

    /**
     * @Id
     * @Column(type="integer", nullable=false)
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Column(name="ativo", type="boolean")
     */
    protected $active = true;


    /**
     * @Column(name="nome", type="string", length=2, unique=true, nullable=false)
     */
    protected $name;
}