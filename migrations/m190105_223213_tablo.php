<?php

use yii\db\Migration;


class m190105_223213_tablo extends Migration
{
    
    /**
     * {@inheritdoc}
     */
    public function Up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
           $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $TABLE_NAME = 'product';
        $this->createTable($TABLE_NAME, [
            'id' => $this->primaryKey(),
            'name' => $this->string(20)->notNull(),
            'brand' => $this->text()->notNull(),
            'comment' => $this->text()->notNull(),
            'price' => $this->integer()->notNull(),
            'stoch' => $this->integer()->notNull()

        ], $tableOptions);


        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $TABLE_NAME = 'hamper';
        $this->createTable($TABLE_NAME, [
            'id' => $this->primaryKey(),
            'productid' => $this->integer()->notNull(),
            'name' => $this->string(20)->notNull(),
            'brand' => $this->text()->notNull(),
            'comment' => $this->text()->notNull(),
            'quentity' => $this->integer()->notNull(),
            'price' => $this->integer()->notNull(),
            'username' => $this->text()->notNull()
        ], $tableOptions);

    }

    /**
     * {@inheritdoc}
     */
    public function Down()
    {
        $TABLE_NAME = 'product';
        $this->dropTable($TABLE_NAME);


        $TABLE_NAME = 'hamper';
        $this->dropTable($TABLE_NAME);
    }
    
}
