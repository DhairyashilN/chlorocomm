<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <h2 class="text-center" style="color:#f1f1f1"><b>ChloroComm</b></h2>
            </li>
            <li class="<?php if ($page_name == 'dashboard') echo 'active'; ?>">
                <a href="<?php echo site_url('chlorocomm/index');?>"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
            </li>
        <!-- <li class="<?php //if ($page_name == 'send_email') echo 'active'; ?>">
            <a href="<?php //echo site_url('send_email');?>"><i class="fa fa-paper-plane"></i> <span class="nav-label">Send Emails</span></span></a>
        </li> -->
        <!-- End Send Emails -->
        <!-- Add Contacts -->
        <li class="<?php if ($page_name == 'add_contact') echo 'active'; ?>">
            <a href=""><i class="fa fa-users"></i> <span class="nav-label">Contacts</span> <span class="fa arrow"></span></a>
            <ul class="nav nav-second-level collapse" style="">
                <li class="<?php if ($page_link_name == 'category') echo 'active'; ?>">
                    <a href="<?php echo site_url('category');?>" class="collapse-link"><span class="nav-label"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Add Contact Category</span></span></a>
                </li>
                <li class="<?php if ($page_link_name == 'type') echo 'active'; ?>">
                    <a href="<?php echo site_url('contact_type');?>" class="collapse-link"><span class="nav-label"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Add Contact Type</span></span></a>
                </li>
                <li class="<?php if ($page_link_name == 'contacts') echo 'active'; ?>">
                    <a href="<?php echo site_url('contacts');?>" class="collapse-link"><span class="nav-label"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Add Contacts</span></span></a>
                </li>
                <li class="<?php if ($page_link_name == 'vcard_upload') echo 'active'; ?>">
                    <a href="<?php echo site_url('vcard_contacts');?>" class="collapse-link"><span class="nav-label"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Import VCARD Contacts</span></span></a>
                </li>
            </ul>
        </li>
        <!-- End Add Contacts -->
        <li class="<?php if ($page_name == 'sms_section') echo 'active'; ?>">
            <a href=""><i class="fa fa-paper-plane" aria-hidden="true"></i> <span class="nav-label">Send SMS</span><span class="fa arrow"></span></a>
            <ul class="nav nav-second-level collapse">
                <li class="<?php if ($page_link_name == 'send_sms') echo 'active active-sub'; ?>">
                    <a href="<?php echo site_url('send_sms');?>" class="collapse-link"><i class="fa fa-angle-double-right" aria-hidden="true"></i> <span class="nav-label">Quick SMS</span></a>
                </li>
                <li class="<?php if ($page_link_name == 'send_indi_sms') echo 'active active-sub'; ?>">
                    <a href="<?php echo site_url('send_individual');?>" class="collapse-link"><i class="fa fa-angle-double-right" aria-hidden="true"></i> <span class="nav-label">Individual SMS</span></a>
                </li>
                <li class="<?php if ($page_link_name == 'send_bulk_sms') echo 'active active-sub'; ?>">
                    <a href="<?php echo site_url('send_bulk');?>" class="collapse-link"><i class="fa fa-angle-double-right" aria-hidden="true"></i> <span class="nav-label">Group/Bulk SMS</span></a>
                </li>
                <li class="<?php if ($page_link_name == 'schedule_sms') echo 'active active-sub'; ?>">
                    <a href="<?php echo site_url('scheduled_sms');?>" class="collapse-link"><i class="fa fa-angle-double-right" aria-hidden="true"></i> <span class="nav-label">Scheduled SMS</span></a>
                </li>
            </ul>
        </li>
        <!-- Schedule SMS -->
        <li class="<?php if ($page_name == 'schedule_sms_section') echo 'active'; ?>">
            <a href="<?php echo site_url('schedule_festival_sms');?>"><i class="fa fa-calendar-o" aria-hidden="true"></i>  <span class="nav-label">Schedule Festival SMS</span></a>
        </li>
        <!-- End Schedule SMS -->
        <!-- SMS Settings -->
        <li class="<?php if ($page_name == 'sms_settings') echo 'active'; ?>">
            <a href=""><i class="fa fa-gear"></i> <span class="nav-label">SMS Settings</span><span class="fa arrow"></span></a>
            <ul class="nav nav-second-level collapse">
                <li class="<?php if($page_link_name == 'sms_template') echo 'active active-sub'; ?>">
                    <a href="<?php echo site_url('sms_template');?>" class="collapse-link"><i class="fa fa-angle-double-right" aria-hidden="true"></i> <span class="nav-label">Template</span></a>
                </li>
            </ul>
        </li>
        <!-- End SMS Settings -->
        <li class="<?php if ($page_name == 'statistics') echo 'active'; ?>">
            <a href=""><i class="fa fa-bar-chart"></i> <span class="nav-label">Report</span><span class="fa arrow"></span></a>
            <ul class="nav nav-second-level collapse">
                <!-- <li class="<?php if ($page_link_name == 'email_statistics') echo 'active'; ?>">
                    <a href="<?php echo site_url('sent_emails_log');?>" class="collapse-link"><i class="fa fa-angle-double-right" aria-hidden="true"></i> <span class="nav-label">Sent Emails</span></a>
                </li> -->
                <li class="<?php if ($page_link_name == 'sms_statistics') echo 'active'; ?>">
                    <a href="<?php echo site_url('sent_sms_log');?>" class="collapse-link"><i class="fa fa-angle-double-right" aria-hidden="true"></i> <span class="nav-label">Sent SMS</span></a>
                </li>
            </ul>
        </li>
        <!-- Enquiry -->
        <li class="<?php if($page_name == 'customer_enquiry') echo 'active'; ?>">
            <a href="<?php echo site_url('customer_enquiry');?>" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i> <span class="nav-label">Customer Enquiries</span></a>
        </li>
        <!-- End Enquiry -->
        <!-- Personal Reminder -->
        <li class="<?php if($page_name == 'personal_reminder') echo 'active'; ?>">
            <a href="<?php echo site_url('personal_reminder');?>"><i class="fa fa-bell" aria-hidden="true"></i> <span class="nav-label">Personal Reminders</span></a>
        </li>
        <!-- End Personal Reminder -->
        <!-- Dues -->
        <li class="<?php if($page_name == 'my_dues') echo 'active'; ?>">
            <a href="<?php echo site_url('dues');?>"><i class="fa fa-inr" aria-hidden="true"></i> <span class="nav-label">Dues</span></a>
        </li>
        <!-- End Dues -->
        <!-- Debtors -->
        <li class="<?php if($page_name == 'my_debtors') echo 'active'; ?>">
            <a href="<?php echo site_url('debtors');?>"><i class="fa fa-inr" aria-hidden="true"></i> <span class="nav-label">Debtors</span></a>
        </li>
        <!-- End Debtors -->
        <!-- calculator -->
        <li class="<?php if($page_name == 'calculator') echo 'active'; ?>">
            <a href="<?php echo site_url('calculator');?>"><i class="fa fa-calculator" aria-hidden="true"></i> <span class="nav-label">Calculator</span></a>
        </li>
        <!-- End calculator -->
        <!-- calculator -->
        <li class="<?php if($page_name == 'calendar') echo 'active'; ?>">
            <a href="<?php echo site_url('calendar');?>"><i class="fa fa-calendar" aria-hidden="true"></i> <span class="nav-label">Calendar</span></a>
        </li>
        <!-- End calculator -->
    </ul>
</div>
</nav>