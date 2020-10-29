<nav class="sidebar sidebar-offcanvas dynamic-active-class-disabled" id="sidebar">
  <ul class="nav">
    <li class="nav-item {{ active_class(['/profile']) }}">
      <a class="nav-link" href="{{ url('/profile') }}">
        <i class="menu-icon mdi mdi-account-card-details"></i>
        <span class="menu-title">Appraisee Information</span>
      </a>
    </li>
    <li class="nav-item {{ active_class(['objectives']) }}">
      <a class="nav-link" href="{{ url('/objectives') }}">
        <i class="menu-icon mdi mdi-chart-line"></i>
        <span class="menu-title">Performance Objectives</span>
      </a>
    </li>
    <li class="nav-item {{ active_class(['kpis/add']) }}">
      <a class="nav-link" href="{{ url('/kpis/add') }}">
        <i class="menu-icon mdi mdi-table-large"></i>
        <span class="menu-title">KPIs</span>
      </a>
    </li>
    <li class="nav-item {{ active_class(['icons/material']) }}">
      <a class="nav-link" href="{{ url('/icons/material') }}">
        <i class="menu-icon mdi mdi-ray-vertex "></i>
        <span class="menu-title">Mid Year Review</span>
      </a>
    </li>
    <li class="nav-item {{ active_class(['icons/material']) }}">
      <a class="nav-link" href="{{ url('/icons/material') }}">
        <i class="menu-icon mdi mdi-ray-end "></i>
        <span class="menu-title">End Year Review</span>
      </a>
    </li>
    <li class="nav-item {{ active_class(['icons/material']) }}">
      <a class="nav-link" href="{{ url('/icons/material') }}">
        <i class="menu-icon mdi mdi-emoticon"></i>
        <span class="menu-title">Icons</span>
      </a>
    </li>
  </ul>
</nav>