<?php
namespace kouosl\product\controllers\frontend;
use kouosl\product\models\Product;
use kouosl\product\models\ProductSearch;
use kouosl\product\models\ProductList;
use kouosl\product\models\HamperSearch;
use kouosl\product\models\Hamper;
use kouosl\user\models\User;
use Yii;		
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\base\Models;
/**
 * Default controller for the `Product` and 'Hamper' modules
 */
class DefaultController extends \kouosl\base\controllers\frontend\BaseController
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
        $searchModelProduct = new ProductList();
        $dataProviderProduct = $searchModelProduct->search(Yii::$app->request->queryParams);
        
        $searchModelHamper = new HamperSearch();
        $dataProviderHamper = $searchModelHamper->search(Yii::$app->request->queryParams);
        
        $model = new Product();
        $model2 = new Product();

        $model3 = new Hamper();

        $username =  Yii::$app->user->identity->username;
        /*
        if ($model->load(Yii::$app->request->post()) && $model->validate() ) 
        {   
            $model2 = $model;
            $model2->id = $model2->id+1;
            if ($model2->save())
            {
                Yii::$app->session->setFlash('success', 'Sorunuz iletildi.');
            }
            else
            {
                Yii::$app->session->setFlash('error', 'Hata. Bir sorun meydana geldi.');
            }      
                
            return $this->refresh();
        }
        else 
        {	*/
            $hamper = Yii::$app->db->createCommand('SELECT * FROM hamper WHERE name="Telefon" order by id desc limit 0,20')->queryAll();
            
            return $this->render('_index',[
                'hamper' => $hamper,
                'model' => $model,
                'searchModelProduct' => $searchModelProduct,
                'dataProviderProduct' => $dataProviderProduct,
                'searchModelHamper' => $searchModelHamper,
                'dataProviderHamper' => $dataProviderHamper,
                'model3' => $model3,
                ]);
        
    }
   /**
     * Deletes an existing Hamper model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModelHamper($id)->delete();

        return $this->redirect(['#']);
    }


    /**
     * Displays a single Hamper model.
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
     * Updates an existing Hamper model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model3 = new Hamper();
        $model4 = $this->findModelHamperForProduct($id);
        
        $username =  Yii::$app->user->identity->username;
        
       if($model4 == null)
       {
            $model3->productid = $model->id;
            $model3->name = $model->name;
            $model3->brand = $model->brand;
            $model3->comment = $model->comment;
            $model3->price = $model->price;
            $model3->username = $username;

            if ($model3->load(Yii::$app->request->post())) {
            
                $model->stoch = $model->stoch - $model3->quentity;
                $model3->price = $model->price * $model3->quentity;
              
                if ( $model3->save(false) && $model->save(false)) 
                {
                    Yii::$app->session->setFlash('success', 'Ürün sepetinize başarı ile eklendi ');
                    
    
                }
                else
                {
                    Yii::$app->session->setFlash('error', 'Hata. Bir sorun meydana geldi.');
                }      
               
            }
        }
        
        else 
        {
           // $model3->id = $model4->id;
            $model3->productid = $model4->productid;
            $model3->name = $model4->name;
            $model3->brand = $model4->brand;
            $model3->comment = $model4->comment;
            $model3->price = $model4->price;
            $model3->username = $model4->username;
            if ($model3->load(Yii::$app->request->post())) {
            
                $model->stoch = $model->stoch - $model3->quentity + $model4->quentity;
                $model3->price = $model->price * $model3->quentity;
              
                if ( $model3->save(false) && $model->save(false)) 
                {
                    Yii::$app->session->setFlash('success', 'Ürün sepetinize başarı ile eklendi ');
                    
    
                }
                else
                {
                    Yii::$app->session->setFlash('error', 'Hata. Bir sorun meydana geldi.');
                }      
               
            }
        }


           
        /*
        
        if ($model3->load(Yii::$app->request->post())) {
            
            $model->stoch = $model->stoch - $model3->quentity + $model4->quentity;
            $model3->price = $model->price * $model3->quentity;
           /*
            if($model4 != null){
                $oldQuentity = $model4->quentity;
                $oldid = $model4->id;
                $model4 = $model3;
                $model4->id = $oldid;
                $model4->quentity = $model4->quentity + $oldQuentity;
                $model4->price = $model->price * $model4->quentity;
                if ( $model4->save(false) && $model->save(false)) 
                {
                    Yii::$app->session->setFlash('success', 'Ürün sepetinize başarı ile eklendi ');
                   // $this->actionDelete($oldid);

                }
                
            }
            if ( $model3->save(false) && $model->save(false)) 
            {
                Yii::$app->session->setFlash('success', 'Ürün sepetinize başarı ile eklendi ');
                

            }
            else
            {
                Yii::$app->session->setFlash('error', 'Hata. Bir sorun meydana geldi.');
            }      
           
        }*/
        return $this->render('update', [
            'model' => $model,
            'model3' =>$model3,
        ]);
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
    /**
     * Finds the Hamper model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Hamper the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */

    protected function findModelHamper($id)
    {
        if (($model = Hamper::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findModelHamperForProduct($id)
    {
       // $model = Hamper::find()->AndWhere(['productid'=>$productid]);
        //return $model;
        //->andFilterWhere(['productid' => $id,])
        if (($model = Hamper::findOne($id)) !== null) {
            return $model;
        }

        //throw new NotFoundHttpException('The requested page does not exist.');
    }


}