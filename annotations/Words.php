<?php

namespace Dictionary;

/**
 * @SWG\Definition(definition="word", required={"id", "word", "meaning"})
 */
class word
{

    /**
     * @SWG\Property(format="int64")
     * @var int
     */
    public $id;

    /**
     * @SWG\Property()
     * @var string
     */
    public $word;

    /**
     * @var string
     * @SWG\Property()
     */
    public $meaning;
}
