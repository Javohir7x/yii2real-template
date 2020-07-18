<?php

namespace backend\controllers;

use Imagine\Image\Box;
use Yii;
use backend\models\News;
use backend\models\search\NewsSearch;
use yii\imagine\Image;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * NewsController implements the CRUD actions for News model.
 */
class NewsController extends Controller
{
    /**
     * {@inheritdoc}
     */
        public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => [],
                'rules' => [
                    // allow authenticated users
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    // everything else is denied
                ],
            ],
        ];
    }


    /**
     * Lists all News models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single News model.
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
     * Creates a new News model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new News();

        if ($model->load(Yii::$app->request->post())) {
            $model->image = UploadedFile::getInstance($model, 'image');
            $model->user_id = Yii::$app->user->id;
            if ($model->save()) {
                if($model->upload()) {
                    $model->image = md5($model->image->baseName).'.'.$model->image->extension;
                    $model->save();

                    // COMPRESSING AND RESIZING IMAGE
                    $imagine = Image::getImagine();
                    $image = $imagine->open(\Yii::getAlias('@frontend')."/web/uploads/".$model->image);
                    if($image->getSize()->getHeight() > 800 && $image->getSize()->getHeight() > 800){
                       $image->resize($image->getSize()
                             ->scale(0.8))
                             ->save(\Yii::getAlias('@frontend')."/web/uploads/" . $model->image, ['quality' => 80]);
                    }
                    $image->save(\Yii::getAlias('@frontend')."/web/uploads/" . $model->image, ['quality' => 80]);
                    return $this->redirect(['view', 'id' => $model->id]);
                    }
                }
            }
            return $this->render('create', [
                'model' => $model,
            ]);
        }


    /**
     * Updates an existing News model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $image = $model->image;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->image = UploadedFile::getInstance($model, 'image');
            if ( $model->image and $model->upload() ) {
                $image = md5($model->image->baseName).'.'.$model->image->extension;
                // file is uploaded successfully
                // COMPRESSING AND RESIZING IMAGE
                $imagine = Image::getImagine();
                $imager = $imagine->open(\Yii::getAlias('@frontend')."/web/uploads/".$image);
                if($imager->getSize()->getHeight() > 800 && $imager->getSize()->getHeight() > 800){
                    $imager->resize($imager->getSize()
                        ->scale(0.8))
                        ->save(\Yii::getAlias('@frontend')."/web/uploads/" . $image, ['quality' => 80]);
                }
                $imager->save(\Yii::getAlias('@frontend')."/web/uploads/" . $image, ['quality' => 80]);
            }
            // var_dump($model);
            $model->image = $image;
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing News model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    public function actionUpload()
    {
        reset ($_FILES);
        $temp = current($_FILES);
//         DEBUG BY WRITING IN A FILE
//        $myfile = fopen("newfile2.txt", "w") or die("Unable to open file!");
//        $txt = $temp['tmp_name'];
//        fwrite($myfile, $txt);
//        fclose($myfile);

        // MOVING UPLOADED FILE
        $stamp  = base64_encode(date("Y-m-d h:i:s"));
        move_uploaded_file($temp['tmp_name'],"resources/".$stamp.".jpg");
        return "{ \"location\" : \"resources/".$stamp.".jpg\"}";
    }

    public function tinyValidate($data){
        $data = str_ireplace('<script>',' ', $data);
        $data = str_ireplace('</script>',' ', $data);
        $data = str_ireplace('script',' ', $data);
        $data = str_ireplace('<a',' ', $data);
        $data = str_ireplace('<input',' ', $data);
        $data = str_ireplace('<textarea',' ', $data);
        $data = str_ireplace('<link',' ', $data);
        $data = str_ireplace('href',' ', $data);
        $data = str_ireplace('<meta',' ', $data);
        $data = str_ireplace('<style',' ', $data);
        return $data;
    }

    /**
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
