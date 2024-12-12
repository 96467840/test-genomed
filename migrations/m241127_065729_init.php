<?php

use yii\db\Migration;

class m241127_065729_init extends Migration
{

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // https://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%urls}}', [
            'id' => $this->primaryKey(),
            'url' => $this->string(1024)->notNull()->comment('Целевой адрес'),
            'short_url' => $this->string()->notNull()->unique()->comment('Краткий код ссылки'),
            'redirect_count' => $this->integer()->notNull()->defaultValue(0)
                ->comment('количество переходов'),
        ], $tableOptions);
        $this->createIndex('urls_redirect_count_idx', '{{%urls}}', 'redirect_count');
        $this->createIndex('urls_url_idx', '{{%urls}}', 'url');

        $this->createTable('{{%redirects}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'remote_addr' => $this->string()->notNull(),
            'url_id' => $this->integer()->notNull(),

        ], $tableOptions);
        $this->addForeignKey(
            'redirects_url_id_fkey',
            '{{%redirects}}',
            'url_id',
            '{{%urls}}',
            'id',
            'CASCADE'
        );
        $this->createIndex('redirects_created_at_idx', '{{%redirects}}', 'created_at');
    }

    public function down()
    {
        $this->dropTable('{{%redirects}}');
        $this->dropTable('{{%urls}}');
    }

}
