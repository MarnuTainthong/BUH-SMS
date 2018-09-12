  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar -->
    <section class="sidebar">

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="header">Menu</li>
        <!-- Optionally, you can add icons to the links -->
        <li><a href="<?php echo site_url().$this->config->item('admin')."/Sms_base_data/dashboard" ?>"><i class="fa fa-tachometer"></i> <span>Dash board</span></a></li>
        <li class="treeview">
          <a href="#"><i class="fa fa-info-circle"></i> <span>ข้อมูลพื้นฐาน</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo site_url().$this->config->item('admin')."/Sms_base_data/year" ?>">ปีงบประมาณ</a></li>
            <li><a href="<?php echo site_url().$this->config->item('admin')."/Sms_base_data/vision" ?>">วิสัยทัศน์</a></li>
            <li><a href="<?php echo site_url().$this->config->item('admin')."/Sms_base_data/mission" ?>">พันธกิจ</a></li>
            <li><a href="<?php echo site_url().$this->config->item('admin')."/Sms_base_data/strategy" ?>">ยุทธศาสตร์</a></li>
            <li><a href="<?php echo site_url().$this->config->item('admin')."/Sms_base_data/point" ?>">เป้าประสงค์</a></li>
            <li><a href="<?php echo site_url().$this->config->item('admin')."/Sms_base_data/vpt_sstr" ?>">มุมมองกลยุทธ์</a></li>
            <li><a href="<?php echo site_url().$this->config->item('admin')."/Sms_base_data/sub_strategy" ?>">กลยุทธ์</a></li>
            <li><a href="<?php echo site_url().$this->config->item('admin')."/Sms_base_data/measure" ?>">ตัวบ่งชี้</a></li>
            <li><a href="#">ตำแหน่งในโครงการ</a></li>
            <li><a href="#">สถานะของโครงการ</a></li>
          </ul>
        </li>
        <!-- end class treeview -->
        <li class="treeview">
          <a href="#"><i class="fa fa-cog"></i> <span>ตั้งค่า</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#">ตั้งค่าความสัมพันธ์</a></li>
            <li><a href="#">ตั้งค่าระยะเวลาบันทึกโครงการ</a></li>
          </ul>
        </li>
        <!-- end class treeview -->
        <li class=""><a href="#"><i class="fa fa-link"></i> <span>จัดการโครงการ</span></a></li>
        <li class="treeview">
          <a href="#"><i class="fa fa-cog"></i> <span>บันทึกผล</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#">บันทึกผลการดำเนินโครงการ</a></li>
            <li><a href="#">บันทึกผลการประเมินโครงการ</a></li>
            <li><a href="#">บันทึกผลการประเมินแผนยุทธศาสตร์</a></li>
          </ul>
        </li>
        <!-- end class treeview -->
        <li class=""><a href="#"><i class="fa fa-link"></i> <span>ติดตามความก้าวหน้า</span></a></li>
        <li class="treeview">
          <a href="#"><i class="fa fa-cog"></i> <span>รายงาน</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#">สรุปรายงานผลการดำเนินโครงการตามแผนปฏิบัติการ</a></li>
            <li><a href="#">สรุปรายงานผลการดำเนินงานตามแผนปฏิบัติการ</a></li>
            <li><a href="#">สรุปรายงานผลการดำเนินงานตามกลยุทธ์</a></li>
          </ul>
        </li>
        <!-- end class treeview -->
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>