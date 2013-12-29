<?php

namespace Entities\Vehicle;


/**
 * @Entity
 * @Table(name="cores")
 */
class Color extends \Entities\MY_Entity
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
     * @Column(name="nome", type="string", length=10, unique=true, nullable=false)
     */
    protected $name;
}