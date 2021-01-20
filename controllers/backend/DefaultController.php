<?php
namespace 160202020\product\controllers\backend;

use 160202020\product\models\Hamper;
use 160202020\product\models\Product;
use 160202020\product\models\ProductSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
/**
 * Default controller for the `Product` module
 */
class DefaultController extends \160202020\base\controllers\backend\BaseController
{
     /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

         $model = new Product();
         $tablo2 = Yii::$app->db->createCommand("SELECT * FROM hamper order by 'id' desc")->queryAll();
         $product = Yii::$app->db->createCommand("SELECT * FROM product order by 'id' desc")->queryAll();
         if ($model->load(Yii::$app->request->post()) && $model->validate() ) {
                  
            if ($model->save())
            {
                Yii::$app->session->setFlash('success', 'Başarılı. Soru eklendi.');
            }
            else
            {
                ii::$app->session->setFlash('error', 'Hata. Bir sorun meydana geldi.');
            }      
                
            return $this->refresh();
        } 
        else
        {
            $hamper = Yii::$app->db->createCommand("SELECT * FROM hamper order by 'id' desc")->queryAll();
            
            return $this->render('_index', [
                'hamper' => $hamper,
                'model' => $model,
                'tablo2' => $tablo2,
                'product' => $product,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,                
                
            ]);
        }

    }


    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['#']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
