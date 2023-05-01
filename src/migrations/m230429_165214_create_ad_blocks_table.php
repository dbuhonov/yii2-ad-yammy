<?php

use yii\db\Migration;

class m230429_165214_create_ad_blocks_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%ad_blocks}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'company_id' => $this->smallInteger()->notNull(),
            'position_id' => $this->smallInteger()->notNull(),
            'ad_code_desktop' => $this->text(),
            'ad_code_mobile' => $this->text(),
            'id_banner_scroll_desktop' => $this->string(),
            'id_banner_scroll_mobile' => $this->string(),
            'image_desktop' => $this->string(),
            'image_mobile' => $this->string(),
            'banner_url_desktop' => $this->string(),
            'banner_url_mobile' => $this->string(),
            'is_published' => $this->boolean()->notNull()->defaultValue(false),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%ad_blocks}}');
    }
}
