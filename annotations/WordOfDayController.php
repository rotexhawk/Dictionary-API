<?php

namespace Dictionary;

class WordOfDayController
{

    /**
     * @SWG\Get(
     *     path="/wordofday",
     *     description="Returns 10 words for contribute fragment",
     *     operationId="findWords",
     *     produces={"application/json", "application/xml", "text/xml", "text/html"},
     *     @SWG\Response(
     *         response=200,
     *         description="word response",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/word")
     *         ),
     *     ),
     *     @SWG\Response(
     *         response="default",
     *         description="unexpected error",
     *         @SWG\Schema(
     *             ref="#/definitions/errorModel"
     *         )
     *     )
     * )
     */
    public function findWords()
    {
    }
}