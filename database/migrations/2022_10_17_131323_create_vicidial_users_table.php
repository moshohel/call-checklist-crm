<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVicidialUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vicidial_users', function (Blueprint $table) {
            $table->increments('user_id');
            $table->string('user', 20)->unique('user');
            $table->string('pass', 100);
            $table->string('full_name', 50)->nullable();
            $table->unsignedTinyInteger('user_level')->nullable()->default(1);
            $table->string('user_group', 20)->nullable();
            $table->string('phone_login', 20)->nullable();
            $table->string('phone_pass', 100)->nullable();
            $table->enum('delete_users', ['0', '1'])->nullable()->default('0');
            $table->enum('delete_user_groups', ['0', '1'])->nullable()->default('0');
            $table->enum('delete_lists', ['0', '1'])->nullable()->default('0');
            $table->enum('delete_campaigns', ['0', '1'])->nullable()->default('0');
            $table->enum('delete_ingroups', ['0', '1'])->nullable()->default('0');
            $table->enum('delete_remote_agents', ['0', '1'])->nullable()->default('0');
            $table->enum('load_leads', ['0', '1'])->nullable()->default('0');
            $table->enum('campaign_detail', ['0', '1'])->nullable()->default('0');
            $table->enum('ast_admin_access', ['0', '1'])->nullable()->default('0');
            $table->enum('ast_delete_phones', ['0', '1'])->nullable()->default('0');
            $table->enum('delete_scripts', ['0', '1'])->nullable()->default('0');
            $table->enum('modify_leads', ['0', '1'])->nullable()->default('0');
            $table->enum('hotkeys_active', ['0', '1'])->nullable()->default('0');
            $table->enum('change_agent_campaign', ['0', '1'])->nullable()->default('0');
            $table->enum('agent_choose_ingroups', ['0', '1'])->nullable()->default('1');
            $table->text('closer_campaigns')->nullable();
            $table->enum('scheduled_callbacks', ['0', '1'])->nullable()->default('1');
            $table->enum('agentonly_callbacks', ['0', '1'])->nullable()->default('0');
            $table->enum('agentcall_manual', ['0', '1', '2', '3', '4', '5'])->nullable()->default('0');
            $table->enum('vicidial_recording', ['0', '1'])->nullable()->default('1');
            $table->enum('vicidial_transfers', ['0', '1'])->nullable()->default('1');
            $table->enum('delete_filters', ['0', '1'])->nullable()->default('0');
            $table->enum('alter_agent_interface_options', ['0', '1'])->nullable()->default('0');
            $table->enum('closer_default_blended', ['0', '1'])->nullable()->default('0');
            $table->enum('delete_call_times', ['0', '1'])->nullable()->default('0');
            $table->enum('modify_call_times', ['0', '1'])->nullable()->default('0');
            $table->enum('modify_users', ['0', '1'])->nullable()->default('0');
            $table->enum('modify_campaigns', ['0', '1'])->nullable()->default('0');
            $table->enum('modify_lists', ['0', '1'])->nullable()->default('0');
            $table->enum('modify_scripts', ['0', '1'])->nullable()->default('0');
            $table->enum('modify_filters', ['0', '1'])->nullable()->default('0');
            $table->enum('modify_ingroups', ['0', '1'])->nullable()->default('0');
            $table->enum('modify_usergroups', ['0', '1'])->nullable()->default('0');
            $table->enum('modify_remoteagents', ['0', '1'])->nullable()->default('0');
            $table->enum('modify_servers', ['0', '1'])->nullable()->default('0');
            $table->enum('view_reports', ['0', '1'])->nullable()->default('0');
            $table->enum('vicidial_recording_override', ['DISABLED', 'NEVER', 'ONDEMAND', 'ALLCALLS', 'ALLFORCE'])->nullable()->default('DISABLED');
            $table->enum('alter_custdata_override', ['NOT_ACTIVE', 'ALLOW_ALTER'])->nullable()->default('NOT_ACTIVE');
            $table->enum('qc_enabled', ['0', '1'])->nullable()->default('0');
            $table->integer('qc_user_level')->nullable()->default(1);
            $table->enum('qc_pass', ['0', '1'])->nullable()->default('0');
            $table->enum('qc_finish', ['0', '1'])->nullable()->default('0');
            $table->enum('qc_commit', ['0', '1'])->nullable()->default('0');
            $table->enum('add_timeclock_log', ['0', '1'])->nullable()->default('0');
            $table->enum('modify_timeclock_log', ['0', '1'])->nullable()->default('0');
            $table->enum('delete_timeclock_log', ['0', '1'])->nullable()->default('0');
            $table->enum('alter_custphone_override', ['NOT_ACTIVE', 'ALLOW_ALTER'])->nullable()->default('NOT_ACTIVE');
            $table->enum('vdc_agent_api_access', ['0', '1'])->nullable()->default('0');
            $table->enum('modify_inbound_dids', ['0', '1'])->nullable()->default('0');
            $table->enum('delete_inbound_dids', ['0', '1'])->nullable()->default('0');
            $table->enum('active', ['Y', 'N'])->nullable()->default('Y');
            $table->enum('alert_enabled', ['0', '1'])->nullable()->default('0');
            $table->enum('download_lists', ['0', '1'])->nullable()->default('0');
            $table->enum('agent_shift_enforcement_override', ['DISABLED', 'OFF', 'START', 'ALL'])->nullable()->default('DISABLED');
            $table->enum('manager_shift_enforcement_override', ['0', '1'])->nullable()->default('0');
            $table->enum('shift_override_flag', ['0', '1'])->nullable()->default('0');
            $table->enum('export_reports', ['0', '1'])->nullable()->default('0');
            $table->enum('delete_from_dnc', ['0', '1'])->nullable()->default('0');
            $table->string('email', 100)->nullable()->default('');
            $table->string('user_code', 100)->nullable()->default('');
            $table->string('territory', 100)->nullable()->default('');
            $table->enum('allow_alerts', ['0', '1'])->nullable()->default('0');
            $table->enum('agent_choose_territories', ['0', '1'])->nullable()->default('1');
            $table->string('custom_one', 100)->nullable()->default('');
            $table->string('custom_two', 100)->nullable()->default('');
            $table->string('custom_three', 100)->nullable()->default('');
            $table->string('custom_four', 100)->nullable()->default('');
            $table->string('custom_five', 100)->nullable()->default('');
            $table->string('voicemail_id', 10)->nullable();
            $table->enum('agent_call_log_view_override', ['DISABLED', 'Y', 'N'])->nullable()->default('DISABLED');
            $table->enum('callcard_admin', ['1', '0'])->nullable()->default('0');
            $table->enum('agent_choose_blended', ['0', '1'])->nullable()->default('1');
            $table->enum('realtime_block_user_info', ['0', '1'])->nullable()->default('0');
            $table->enum('custom_fields_modify', ['0', '1'])->nullable()->default('0');
            $table->enum('force_change_password', ['Y', 'N'])->nullable()->default('N');
            $table->enum('agent_lead_search_override', ['NOT_ACTIVE', 'ENABLED', 'LIVE_CALL_INBOUND', 'LIVE_CALL_INBOUND_AND_MANUAL', 'DISABLED'])->nullable()->default('NOT_ACTIVE');
            $table->enum('modify_shifts', ['1', '0'])->nullable()->default('0');
            $table->enum('modify_phones', ['1', '0'])->nullable()->default('0');
            $table->enum('modify_carriers', ['1', '0'])->nullable()->default('0');
            $table->enum('modify_labels', ['1', '0'])->nullable()->default('0');
            $table->enum('modify_statuses', ['1', '0'])->nullable()->default('0');
            $table->enum('modify_voicemail', ['1', '0'])->nullable()->default('0');
            $table->enum('modify_audiostore', ['1', '0'])->nullable()->default('0');
            $table->enum('modify_moh', ['1', '0'])->nullable()->default('0');
            $table->enum('modify_tts', ['1', '0'])->nullable()->default('0');
            $table->enum('preset_contact_search', ['NOT_ACTIVE', 'ENABLED', 'DISABLED'])->nullable()->default('NOT_ACTIVE');
            $table->enum('modify_contacts', ['1', '0'])->nullable()->default('0');
            $table->enum('modify_same_user_level', ['0', '1'])->nullable()->default('1');
            $table->enum('admin_hide_lead_data', ['0', '1'])->nullable()->default('0');
            $table->enum('admin_hide_phone_data', ['0', '1', '2_DIGITS', '3_DIGITS', '4_DIGITS'])->nullable()->default('0');
            $table->enum('agentcall_email', ['0', '1'])->nullable()->default('0');
            $table->enum('modify_email_accounts', ['0', '1'])->nullable()->default('0');
            $table->unsignedTinyInteger('failed_login_count')->nullable()->default(0);
            $table->dateTime('last_login_date')->nullable()->default('2001-01-01 00:00:01');
            $table->string('last_ip', 15)->nullable()->default('');
            $table->string('pass_hash', 500)->nullable()->default('');
            $table->enum('alter_admin_interface_options', ['0', '1'])->nullable()->default('1');
            $table->unsignedSmallInteger('max_inbound_calls')->nullable()->default(0);
            $table->enum('modify_custom_dialplans', ['1', '0'])->nullable()->default('0');
            $table->smallInteger('wrapup_seconds_override')->nullable()->default(-1);
            $table->enum('modify_languages', ['1', '0'])->nullable()->default('0');
            $table->string('selected_language', 100)->nullable()->default('default English');
            $table->enum('user_choose_language', ['1', '0'])->nullable()->default('0');
            $table->enum('ignore_group_on_search', ['1', '0'])->nullable()->default('0');
            $table->enum('api_list_restrict', ['1', '0'])->nullable()->default('0');
            $table->string('api_allowed_functions', 1000)->nullable()->default(' ALL_FUNCTIONS ');
            $table->string('lead_filter_id', 20)->nullable()->default('NONE');
            $table->enum('admin_cf_show_hidden', ['1', '0'])->nullable()->default('0');
            $table->enum('agentcall_chat', ['1', '0'])->nullable()->default('0');
            $table->enum('user_hide_realtime', ['1', '0'])->nullable()->default('0');
            $table->enum('access_recordings', ['0', '1'])->nullable()->default('0');
            $table->enum('modify_colors', ['1', '0'])->nullable()->default('0');
            $table->string('user_nickname', 50)->nullable()->default('');
            $table->smallInteger('user_new_lead_limit')->nullable()->default(-1);
            $table->enum('api_only_user', ['0', '1'])->nullable()->default('0');
            $table->enum('modify_auto_reports', ['1', '0'])->nullable()->default('0');
            $table->enum('modify_ip_lists', ['1', '0'])->nullable()->default('0');
            $table->enum('ignore_ip_list', ['1', '0'])->nullable()->default('0');
            $table->mediumInteger('ready_max_logout')->nullable()->default(-1);
            $table->enum('export_gdpr_leads', ['0', '1', '2'])->nullable()->default('0');
            $table->enum('pause_code_approval', ['1', '0'])->nullable()->default('0');
            $table->unsignedSmallInteger('max_hopper_calls')->nullable()->default(0);
            $table->unsignedSmallInteger('max_hopper_calls_hour')->nullable()->default(0);
            $table->enum('mute_recordings', ['DISABLED', 'Y', 'N'])->nullable()->default('DISABLED');
            $table->enum('hide_call_log_info', ['DISABLED', 'Y', 'N', 'SHOW_1', 'SHOW_2', 'SHOW_3', 'SHOW_4', 'SHOW_5', 'SHOW_6', 'SHOW_7', 'SHOW_8', 'SHOW_9', 'SHOW_10'])->nullable()->default('DISABLED');
            $table->enum('next_dial_my_callbacks', ['NOT_ACTIVE', 'DISABLED', 'ENABLED'])->nullable()->default('NOT_ACTIVE');
            $table->text('user_admin_redirect_url')->nullable();
            $table->enum('max_inbound_filter_enabled', ['0', '1'])->nullable()->default('0');
            $table->text('max_inbound_filter_statuses')->nullable();
            $table->text('max_inbound_filter_ingroups')->nullable();
            $table->smallInteger('max_inbound_filter_min_sec')->nullable()->default(-1);
            $table->string('status_group_id', 20)->nullable()->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vicidial_users');
    }
}
