<?php
namespace App\Year2023\Day20;

use App\AdventTask;

class PartTwo extends AdventTask
{
    public $signals = ['l' => 0, 'h' => 0];
    public $data = [];

    public function execute(): void
    {
        foreach ($this->table as $key => $item) {
            $temp = explode(' -> ', $item);
            $type = $temp[0];
            if ($type == 'broadcaster') {
                $this->data['broadcaster'] = [
                    'val' => 'broadcaster',
                    'type' => 'broadcaster',
                    'destination' => explode(', ', $temp[1]),
                ];
            } else {
                $this->data[substr($type, 1)] = [
                    'val' => substr($type, 1),
                    'type' => substr($type, 0, 1),
                    'destination' => explode(', ', $temp[1]),
                ];
            }
        }

        foreach ($this->data as $key => &$item) {
            if ($item['type'] == '&') {
                $item['income'] = [];
                foreach ($this->data as $k => $v) {
                    if (in_array($key, $v['destination'])) {
                        $item['income'][$k] = 0;
                    }
                }
            }

            if ($item['type'] == '%') {
                $item['condition'] = 'off';
            }
        }

        for ($i=0; $i < 10000000; $i++) {
            $this->signals['l']++;
            $sends = $this->sendSignal($this->data['broadcaster'], 'l');

            while (!empty($sends)) {
                $newSends = [];
                foreach ($sends as $send) {
                    $temp = $this->sendSignal($send, $send['signal']);
                    foreach ($temp as $t) {
                        $newSends[]=$t;
                    }
                }

                $sends = $newSends;
            }

        }
        $this->result = $this->signals['l'] * $this->signals['h'];

    }

    public function sendSignal($data, $income)
    {
        $sends = [];
        foreach ($data['destination'] as $k => $v) {
            $this->signals[$income]++;
            if ($v == 'kl' && $data['val'] == 'zc') {
                if ($income == 'h') {
                    return 'false';
                }
            }
            if (empty($this->data[$v])) {
                return [];
            }
            $item = $this->data[$v];


            switch ($item['type']) {
                case '&':
                    $item['income'][$data['val']] = ($income == 'l') ? 0 : 1;
                    $this->data[$v]['income'][$data['val']] = $item['income'][$data['val']];
                    if (array_sum($item['income']) == count($item['income'])) {
                        $sends[$item['val']] = ['destination' => $item['destination'], 'signal' => 'l', 'val' => $item['val'], 'type' => $item['type']];
                    } else {
                        $sends[$item['val']] = ['destination' => $item['destination'], 'signal' => 'h', 'val' => $item['val'], 'type' => $item['type']];
                    }
                    break;
                case '%':
                    if ($income == 'l') {
                       if ($item['condition'] == 'on') {
                           $this->data[$v]['condition'] = 'off';
                           $sends[$item['val']] = ['destination' => $item['destination'], 'signal' => 'l', 'val' => $item['val'], 'type' => $item['type'], 'condition' => 'off'];
                       } else {
                           $this->data[$v]['condition'] = 'on';
                           $sends[$item['val']] = ['destination' => $item['destination'], 'signal' => 'h', 'val' => $item['val'], 'type' => $item['type'], 'condition' => 'on'];
                       }
                    }
                    break;
                default:
                    break;
            }
        }

        return $sends;
    }

}