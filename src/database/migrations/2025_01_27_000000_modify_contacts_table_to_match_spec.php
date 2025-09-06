<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyContactsTableToMatchSpec extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contacts', function (Blueprint $table) {
            // Add columns only if they do not exist
            if (!Schema::hasColumn('contacts', 'category_id')) {
                $table->bigInteger('category_id')->unsigned();
            }
            if (!Schema::hasColumn('contacts', 'first_name')) {
                $table->string('first_name');
            }
            if (!Schema::hasColumn('contacts', 'last_name')) {
                $table->string('last_name');
            }
            if (!Schema::hasColumn('contacts', 'gender')) {
                $table->tinyInteger('gender'); // 1:男性 2:女性 3:その他
            }
            if (!Schema::hasColumn('contacts', 'email')) {
                $table->string('email');
            }
            if (!Schema::hasColumn('contacts', 'tel')) {
                $table->string('tel', 11);
            }
            if (!Schema::hasColumn('contacts', 'address')) {
                $table->string('address');
            }
            if (!Schema::hasColumn('contacts', 'building')) {
                $table->string('building')->nullable();
            }
            if (!Schema::hasColumn('contacts', 'detail')) {
                $table->text('detail');
            }
            if (!Schema::hasColumn('contacts', 'created_at') && !Schema::hasColumn('contacts', 'updated_at')) {
                $table->timestamps();
            }
        });
        // Add foreign key constraint for category_id if it does not exist
        if (!\Illuminate\Support\Facades\Schema::hasColumn('contacts', 'category_id')) {
            // The column was just added above, so add foreign key in the same migration
            Schema::table('contacts', function (Blueprint $table) {
                $table->foreign('category_id')->references('id')->on('categories');
            });
        } else {
            // Check if foreign key exists, add if not (best effort, Laravel doesn't provide a direct way to check)
            // Try/catch to avoid errors if already exists
            try {
                Schema::table('contacts', function (Blueprint $table) {
                    $table->foreign('category_id')->references('id')->on('categories');
                });
            } catch (\Exception $e) {
                // Foreign key probably already exists, ignore
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Drop foreign key constraint if exists
        Schema::table('contacts', function (Blueprint $table) {
            if (Schema::hasColumn('contacts', 'category_id')) {
                // Use the default convention for FK name: contacts_category_id_foreign
                $sm = Schema::getConnection()->getDoctrineSchemaManager();
                $doctrineTable = $sm->listTableDetails('contacts');
                if ($doctrineTable->hasForeignKey('contacts_category_id_foreign')) {
                    $table->dropForeign('contacts_category_id_foreign');
                } else {
                    // fallback: try dropForeign with array syntax
                    try {
                        $table->dropForeign(['category_id']);
                    } catch (\Exception $e) {}
                }
            }
        });
        // Drop columns that were added
        Schema::table('contacts', function (Blueprint $table) {
            $columns = [
                'category_id', 'first_name', 'last_name', 'gender', 'email',
                'tel', 'address', 'building', 'detail', 'created_at', 'updated_at'
            ];
            foreach ($columns as $col) {
                if (Schema::hasColumn('contacts', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
}
