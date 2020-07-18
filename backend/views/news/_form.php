<script src="/backend/web/assets/425ec420/tinymce.js"></script>
<?php
$scr = <<<JS
$( document ).ready(function() {
    tinymce.init({
    selector: 'textarea',
    invalid_elements : 'a,form,button,script,input',
    images_upload_url: '/backend/web/news/upload',
	images_upload_base_path: '/backend/web/',
	images_upload_credentials: true,
    paste_data_images: true,
    plugins : 'advlist autolink lists link charmap hr preview pagebreak,'+
              'searchreplace wordcount visualblocks visualchars code fullscreen '+
              'save insertdatetime table  paste  '+
              'media contextmenu template image responsivefilemanager filemanager',
    toolbar : 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist' +
              'numlist outdent indent | responsivefilemanager link image media',
    external_filemanager_path:  '/admin/plugins/responsivefilemanager/filemanager/',
    filemanager_title : 'Responsive Filemanager',
    external_plugins : {
            //Иконка/кнопка загрузки файла в диалоге вставки изображения.
            'filemanager' : '/admin/plugins/responsivefilemanager/filemanager/plugin.min.js',
            //Иконка/кнопка загрузки файла в панеле иснструментов.
            'responsivefilemanager' :  '/admin/plugins/responsivefilemanager/tinymce/plugins/responsivefilemanager/plugin.min.js'
        },
         
  init_instance_callback : function(editor) {
   editor.on('drop', function(e) {
        });
      }
   });
});
JS;
$this->registerJs($scr);


use kartik\select2\Select2;
use mludvik\tagsinput\TagsInputWidget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;

/* @var $this yii\web\View */
/* @var $model backend\models\News */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-form">
 <?php  echo \Yii::getAlias('@frontend') ?>
    <?php $form = ActiveForm::begin(['enableClientScript' => false]); ?>

    <?= $form->field($model, 'title')->textInput()->label('Yangilik sarlavhasi') ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 20])->label('Yangilik matni') ?>


    <?= $form->field($model, 'language')->dropDownList([
        'uz' => 'O\'zbek (Lotin)',
        'oz' => 'O\'zbek (Kril)',
        'ru' => 'Русскый',
    ])->label('Tilni tanlang') ?>


   <?php
   $tags  = "";
   if($model->tags==null) {
       $data = \backend\models\News::find()
           ->select(['tags'])
           ->where(['status' => 1])
           ->asArray()->all();
       for ($i = 0; $i < count($data); $i++) {
           $tags .= $data[$i]['tags'] . ',';
       }
   } else
       $tags = $model->tags;
   $tags = explode(' ', str_replace([',', '.', '-', ', ', ' ,'], ' ', $tags));
   $tags = array_combine($tags, $tags);
   echo $form->field($model, 'tags')->widget(Select2::classname(), [
       'data' => $tags,
       'options' => [
           'placeholder' => 'Teglarni kiriting...',
           'multiple'    => true,
           'value'       => (Yii::$app->controller->action->id=='create')?'':$tags
       ],
       'pluginOptions' => [
           'multiple' => true,
           'tags' => true,
           'tokenSeparators' => [',',' ','.','-'],
           'maximumInputLength' => 10
       ],
   ])->label('Yangilik uchun teglar (vergul yoki bo\'shliq orqali ajrating)'); ?>

    <?= $form->field($model, 'status')->dropDownList([
        1 => 'Aktiv holatda',
        0 => 'Aktiv emas',
    ])->label('Yangilik holati') ?>


    <?= $form->field($model, 'category_id')->dropDownList(
            ArrayHelper::map(\backend\models\Categories::find()->asArray()->all(), 'id', 'title')
    )->label('Yangilik kategoriyasi') ?>


    <?= $form->field($model, 'priority')->dropDownList([
        0 => 'Har kunlik yangilik',
        1 => 'Dolzarb yangilik',
        2 => 'Tavsiya etiladi',
    ])->label('Muhumlik darajasini tanlash') ?>


    <?= $form->field($model, 'image')->fileInput()->label('Yangilik uchun rasm tanlash') ?>


    <div class="form-group">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
