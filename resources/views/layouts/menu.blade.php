 <div class="deznav">
     <div class="deznav-scroll">
         <a href="javascript:void(0)" class="add-menu-sidebar" data-toggle="modal" data-target="#newCita">+ New
             Cita</a>
         <ul class="metismenu" id="menu">
             <li><a href="{{route('index')}}" class="ai-icon" aria-expanded="false">
                     <i class="flaticon-381-home"></i>
                     <span class="nav-text">Inicio</span>
                 </a>
             </li>


             <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                     <i class="flaticon-381-user"></i>

                     <span class="nav-text">Usuarios</span>
                 </a>
                 <ul aria-expanded="false">
                     <li><a href="{{ route('administradores') }}">Administradores</a></li>
                     <li><a href="{{ route('medicos') }}">Medicos</a></li>
                     <li><a href="{{ route('pacientes') }}">Pacientes</a></li>
                     <li><a href="{{ route('farmaceutas') }}">Farmaceutas</a></li>
                 </ul>
             </li>


             <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                     <i class="flaticon-381-bookmark-1"></i>

                     <span class="nav-text">Citas</span>
                 </a>
                 <ul aria-expanded="false">
                     <li><a href="{{ route('citas') }}">Citas</a></li>
                     <li><a href="{{ route('triaje.index') }}">Triaje</a></li>
                     <li><a href="{{ route('diagnostico.index') }}">Diagnostico</a></li>
                 </ul>
             </li>

             <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                     <i class="flaticon-381-bookmark-1"></i>

                     <span class="nav-text">Pagos</span>
                 </a>
                 <ul aria-expanded="false">
                     <li><a href="{{ route('pago.index') }}">Pagos Por Generar</a></li>
                     <li><a href="{{ route('pago.realizados') }}">Pagos Realizados</a></li>
                 </ul>
             </li>

             {{-- <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                     <i class="flaticon-381-bookmark-1"></i>

                     <span class="nav-text">Pacientes</span>
                 </a>
                 <ul aria-expanded="false">
                     <li><a href="{{ route('pago.index') }}">Servicios Adicionales</a></li>

                     <li><a href="{{ route('pacientes') }}">Historia Clinica</a></li>
                 </ul>
             </li> --}}

             <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                     <i class="flaticon-381-bookmark-1"></i>

                     <span class="nav-text">Farmacia</span>
                 </a>
                 <ul aria-expanded="false">
                     <li><a href="{{ route('farmacia.index') }}">Buscar Receta</a></li>
                     <li><a href="{{ route('farmacia.venta') }}">Vender</a></li>
                     <li><a href="{{ route('triaje.index') }}">Ventas</a></li>
                     <li><a href="{{ route('farmacia.medicamentos') }}">Medicamentos</a></li>
                 </ul>
             </li>



             <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                     <i class="flaticon-381-settings-2"></i>

                     <span class="nav-text">Configuraciones</span>
                 </a>
                 <ul aria-expanded="false">
                     <li><a href="{{ route('horarios.index') }}">Bloques Horarios</a></li>
                     <li><a href="{{ route('servicios.index') }}">Servicios</a></li>
                     <li><a href="{{ route('empresa.index') }}">Informacion Clinica</a></li>
                 </ul>
             </li>
         </ul>

     </div>
 </div>
