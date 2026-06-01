<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // invitation_musics.invitation_id
        Schema::table('invitation_musics', function (Blueprint $table) {
            if (!$this->indexExists('invitation_musics', 'invitation_musics_invitation_id_index')) {
                $table->index('invitation_id');
            }
        });

        // digital_gifts.invitation_id
        Schema::table('digital_gifts', function (Blueprint $table) {
            if (!$this->indexExists('digital_gifts', 'digital_gifts_invitation_id_index')) {
                $table->index('invitation_id');
            }
        });

        // rsvps.invitation_id
        Schema::table('rsvps', function (Blueprint $table) {
            if (!$this->indexExists('rsvps', 'rsvps_invitation_id_index')) {
                $table->index('invitation_id');
            }
        });

        // guestbook_entries.invitation_id
        Schema::table('guestbook_entries', function (Blueprint $table) {
            if (!$this->indexExists('guestbook_entries', 'guestbook_entries_invitation_id_index')) {
                $table->index('invitation_id');
            }
        });

        // invitation_galleries.invitation_id
        Schema::table('invitation_galleries', function (Blueprint $table) {
            if (!$this->indexExists('invitation_galleries', 'invitation_galleries_invitation_id_index')) {
                $table->index('invitation_id');
            }
        });

        // invitations.slug (for fast public URL lookup)
        Schema::table('invitations', function (Blueprint $table) {
            if (!$this->indexExists('invitations', 'invitations_slug_index')) {
                $table->index('slug');
            }
        });

        // invitations.uuid (for builder URL)
        Schema::table('invitations', function (Blueprint $table) {
            if (!$this->indexExists('invitations', 'invitations_uuid_index')) {
                $table->index('uuid');
            }
        });

        // invitations.user_id + status (dashboard query)
        Schema::table('invitations', function (Blueprint $table) {
            if (!$this->indexExists('invitations', 'invitations_user_id_status_index')) {
                $table->index(['user_id', 'status']);
            }
        });
    }

    public function down(): void
    {
        Schema::table('invitation_musics',   fn(Blueprint $t) => $t->dropIndexIfExists(['invitation_id']));
        Schema::table('digital_gifts',       fn(Blueprint $t) => $t->dropIndexIfExists(['invitation_id']));
        Schema::table('rsvps',               fn(Blueprint $t) => $t->dropIndexIfExists(['invitation_id']));
        Schema::table('guestbook_entries',   fn(Blueprint $t) => $t->dropIndexIfExists(['invitation_id']));
        Schema::table('invitation_galleries',fn(Blueprint $t) => $t->dropIndexIfExists(['invitation_id']));
        Schema::table('invitations',         fn(Blueprint $t) => $t->dropIndexIfExists(['slug']));
        Schema::table('invitations',         fn(Blueprint $t) => $t->dropIndexIfExists(['uuid']));
        Schema::table('invitations',         fn(Blueprint $t) => $t->dropIndexIfExists(['user_id','status']));
    }

    private function indexExists(string $table, string $index): bool
    {
        return collect(\DB::select("SHOW INDEX FROM `{$table}`"))
            ->pluck('Key_name')
            ->contains($index);
    }
};
