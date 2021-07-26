<?php
/*
 * Copyright (C) 2020 Joe Nilson <joenilson@gmail.com>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 * You should have received a copy of the GNU Lesser General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace FacturaScripts\Plugins\fsRepublicaDominicana\Extension\Controller;

use FacturaScripts\Core\Model\Base\ModelCore;
use FacturaScripts\Dinamic\Lib\AssetManager;
use FacturaScripts\Dinamic\Model\NCFTipo;
use FacturaScripts\Dinamic\Model\NCFTipoAnulacion;
use FacturaScripts\Dinamic\Model\NCFTipoPago;
use FacturaScripts\Dinamic\Model\NCFTipoMovimiento;

class EditFacturaCliente
{
    public function createViews(): \Closure
    {

        return function () {
            parent::createViews();
            AssetManager::add('js', \FS_ROUTE . '/Plugins/fsRepublicaDominicana/Assets/JS/CommonModals.js');
            AssetManager::add('js', \FS_ROUTE . '/Plugins/fsRepublicaDominicana/Assets/JS/CommonDomFunctions.js');
            $ncfTipoPago = new NCFTipoPago();
            $ncfTiposPago = $ncfTipoPago->findAllByTipopago('01');
            $customValuesNTP = [];
            $customValuesNTP[] = ['value' => '', 'title' => '-----------'];
            foreach ($ncfTiposPago as $tipopago) {
                $customValuesNTP[] = ['value' => $tipopago->codigo, 'title' => $tipopago->descripcion];
            }
            $columnToModifyNTP = $this->views['EditFacturaCliente']->columnForName('ncf-payment-type');
            if ($columnToModifyNTP) {
                $columnToModifyNTP->widget->setValuesFromArray($customValuesNTP);
            }

            $ncfTipoAnulacion = new NCFTipoAnulacion();
            $ncfTiposAnulacion = $ncfTipoAnulacion->all();
            $customValuesNTA = [];
            $customValuesNTA[] = ['value' => '', 'title' => '-----------'];
            foreach ($ncfTiposAnulacion as $tipoanulacion) {
                $customValuesNTA[] = ['value' => $tipoanulacion->codigo, 'title' => $tipoanulacion->descripcion];
            }
            $columnToModifyNTA1 = $this->views['EditFacturaCliente']->columnForName('ncf-cancellation-type');
            if ($columnToModifyNTA1) {
                $columnToModifyNTA1->widget->setValuesFromArray($customValuesNTA);
            }

//            $columnToModifyNTA2 = $this->views['RefundFacturaCliente']->columnForName('ncf-cancellation-type');
//            if($columnToModifyNTA2) {
//                $columnToModifyNTA2->widget->setValuesFromArray($customValuesNTA);
//            }

            $ncfTipoMovimiento = new NCFTipoMovimiento();
            $ncfTiposMovimiento = $ncfTipoMovimiento->findAllByTipomovimiento('VEN');
            $customValuesNTM = [];
            $customValuesNTM[] = ['value' => '', 'title' => '-----------'];
            foreach ($ncfTiposMovimiento as $tipomovimiento) {
                $customValuesNTM[] = ['value' => $tipomovimiento->codigo, 'title' => $tipomovimiento->descripcion];
            }
            $columnToModifyNTM = $this->views['EditFacturaCliente']->columnForName('ncf-movement-type');
            if ($columnToModifyNTM) {
                $columnToModifyNTM->widget->setValuesFromArray($customValuesNTM);
            }
        };
    }

//    protected function subjectChangedAction()
//    {
//        return function () {
//            $this->setTemplate(false);
//
//            //Client data
//            $cliente0 = new Cliente();
//
//            /// loads model
//            $data = $this->getBusinessFormData();
//            $cliente = $cliente0->get($data['subject']['codcliente']);
//            print_r($cliente);
//            $data['form']['codsubtipodoc'] = (isset($data['form']['codsubtipodoc'])) ? $cliente->codsubtipodoc : "02";
//            $data['form']['codoperaciondoc'] = (isset($data['form']['codoperaciondoc'])) ? "01" : "LIMPIO";
//            $data['form']['ncftipopago'] = (!isset($data['form']['ncftipopago'])) ? $cliente->ncftipopago : "";
//
//            $merged = array_merge($data['custom'], $data['final'], $data['form'], $data['subject']);
//            $this->views[$this->active]->loadFromData($merged);
//
//            /// update subject data?
//            if (!$this->views[$this->active]->model->exists()) {
//                $this->views[$this->active]->model->updateSubject();
//            }
//
//            $this->response->setContent(json_encode($this->views[$this->active]->model));
//            return false;
//        };
//    }
}