<?php

/**
 * @SWG\Swagger(
 *     basePath="",
 *     host="localhost/~yasinyaqoobi/dictionary_api",
 *     schemes={"http"},
 *     produces={"application/json"},
 *     consumes={"application/json"},
 *     @SWG\Info(
 *         version="1.0.0",
 *         title="Dari Dictionary API",
 *         description="A rest api for Dari Dictionary",
 *         termsOfService="http://dari.cyberserge.com/terms/",
 *         @SWG\Contact(name="Yasin Yaqoobi"),
 *         @SWG\License(name="MIT")
 *     ),
 *     @SWG\Definition(
 *         definition="errorModel",
 *         required={"code", "message"},
 *         @SWG\Property(
 *             property="code",
 *             type="integer",
 *             format="int32"
 *         ),
 *         @SWG\Property(
 *             property="message",
 *             type="string"
 *         )
 *     )
 * )
 */
