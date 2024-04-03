<?php

namespace app\models;

use Exception;
use GuzzleHttp\Client;
use Yii;

/**
 * This is the model class for table "provas_feitas".
 *
 * @property int $id
 * @property string|null $assunto
 * @property string|null $data
 * @property int|null $acertos
 * @property int|null $questoes
 * @property float|null $porcentagem
 */
class ProvasFeitas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'provas_feitas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['data'], 'safe'],
            [['acertos', 'questoes'], 'default', 'value' => null],
            [['acertos', 'questoes'], 'integer'],
            [['porcentagem'], 'number'],
            [['assunto'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'assunto' => 'Assunto',
            'data' => 'Data',
            'acertos' => 'Acertos',
            'questoes' => 'Questoes',
            'porcentagem' => 'Porcentagem',
        ];
    }

    public function formatDate($data)
    {
        $date = $data;
        return date('Y-m-d', strtotime($date));
    }

    public function getPorcentForQuestions($acertos, $questoes)
    {
        if ($questoes != 0) {
            $porcentagem = ($acertos / $questoes) * 100;
        } else {
            $porcentagem = 0;
        }

        return $porcentagem;
    }

    public function getAllQuestions()
    {
        $questoes = Yii::$app->db->createCommand("SELECT SUM(questoes) FROM provas_feitas")->queryOne();
        return $questoes['sum'];
    }


    public function getSumForQuestionsMonth()
    {
        $questoes = Yii::$app->db->createCommand("SELECT EXTRACT(MONTH FROM data) AS mes, SUM(questoes) AS total_questoes
        FROM provas_feitas
        GROUP BY EXTRACT(MONTH FROM data)
        ORDER BY mes")
            ->queryAll();
        return $questoes;
    }

    public function getSumQuestionToday()
    {
        $today = date('Y-m-d');

        $questoes = Yii::$app->db->createCommand("
            SELECT SUM(questoes) AS total_questoes
            FROM provas_feitas
            WHERE DATE(data) = :today
        ", [':today' => $today])->queryOne();

        return $questoes['total_questoes'];
    }


    public function getSumQuestionThisWeek()
    {
        $today = date('Y-m-d');

        $week_start = date('Y-m-d', strtotime('-7 days', strtotime($today)));

        $questoes = Yii::$app->db->createCommand("
        SELECT SUM(questoes) AS total_questoes
        FROM provas_feitas
        WHERE DATE(data) BETWEEN :week_start AND :today
    ", [':week_start' => $week_start, ':today' => $today])->queryOne();

        return $questoes['total_questoes'];
    }


    public function generateQrCode()
    {
        $client = new Client();

        $url = 'https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=https://getbootstrap.com/docs/5.2/content/tables/#overview';

        try {
            $response = $client->request('GET', $url);

            $body = $response->getBody();

            file_put_contents('qrcode.png', $body);

            echo '<img src="data:image/png;base64,' . base64_encode($body) . '" alt="QR Code">';
        } catch (Exception $e) {
            echo 'Erro: ' . $e->getMessage();
        }
    }


    /**
     * {@inheritdoc}
     * @return ProvasFeitasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProvasFeitasQuery(get_called_class());
    }
}
