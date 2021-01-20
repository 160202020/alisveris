<?php
namespace 160202020\product\controllers\console;


/**
 * Default controller for the `Product` module
 */
class DefaultController extends \160202020\base\controllers\console\BaseController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('_index');
    }
}
