<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Url;

class SitemapController extends Controller
{
    public function actionIndex()
    {
        $pageSize = 20000;
        $db = \Yii::$app->db;
        $summaryHandle = fopen('sitemap.xml','w+');
        $summaryBegin = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<sitemap>\n";
        $summaryEnd = "</sitemap>";
        $summaryContent = '';
        $date = date('Y-m-d',time());
        $total = $db->createCommand("select count(*) from info")->queryScalar();
        $count = ceil($total/$pageSize);
        for ($i = 1; $i <= $count; $i++) {
            $offset = ($i-1) * $pageSize;
            $ids = $db->createCommand("select id from info order by id desc limit $offset,$pageSize")->queryColumn();
            $summaryContent .= "<loc>http://bt.yssousuo.com/sitemap$i.xml</loc>\n";
            $summaryContent .= "<lastmod>$date</lastmod>\n";
            $detailHandle = fopen("sitemap$i.xml",'w+');
            $detailBegin = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<?xml-stylesheet type=\"text/xsl\" href=\"sitemap.xsl\"?>\n<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\" xmlns:mobile=\"http://www.baidu.com/schemas/sitemap-mobile/1/\">\n";
            $detailEnd = "</urlset>";
            $detailContent = '';
            foreach ($ids as $id) {
                $detailContent .= "<url>\n<mobile:mobile type=\"htmladapt\"/>\n<loc>http://bt.yssousuo.com/$id</loc>\n<priority>0.80</priority>\n<lastmod>$date</lastmod>\n<changefreq>Always</changefreq>\n</url>\n";
            }
            fwrite($detailHandle, $detailBegin.$detailContent.$detailEnd);
            fclose($detailHandle);
        }
        fwrite($summaryHandle, $summaryBegin.$summaryContent.$summaryEnd);
        fclose($summaryHandle);
        return $this->redirect(Url::to(['sitemap/topic']));
    }

    public function actionTopic()
    {
        $db = \Yii::$app->db;
        $date = date('Y-m-d',time());
        $ids = $db->createCommand("select id from topic order by id desc")->queryColumn();
        $detailHandle = fopen("sitemapTopic.xml",'w+');
        $detailBegin = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<?xml-stylesheet type=\"text/xsl\" href=\"sitemap.xsl\"?>\n<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\" xmlns:mobile=\"http://www.baidu.com/schemas/sitemap-mobile/1/\">\n";
        $detailEnd = "</urlset>";
        $detailContent = '';
        foreach ($ids as $id) {
            $detailContent .= "<url>\n<mobile:mobile type=\"htmladapt\"/>\n<loc>http://bt.yssousuo.com/t/$id</loc>\n<priority>0.80</priority>\n<lastmod>$date</lastmod>\n<changefreq>Always</changefreq>\n</url>\n";
        }
        fwrite($detailHandle, $detailBegin.$detailContent.$detailEnd);
        fclose($detailHandle);
    }
}
?>
