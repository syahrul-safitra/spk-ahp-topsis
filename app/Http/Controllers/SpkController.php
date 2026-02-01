<?php

namespace App\Http\Controllers;

use App\Models\ComparisonMatrix;
use App\Models\Criteria;
use Illuminate\Http\Request;

use App\Services\AhpService;

class SpkController extends Controller
{
    public function testAhp(AhpService $ahp) {
        $result = $ahp->calculate();

        // return $result;

        return view('Ahp.test', [
            'matrix'      => $result['matrix'],
            'normalized'  => $result['normalized'],
            'weights'     => $result['weights'],
            'lambda_max'  => $result['lambdaMax'],
            'ci'          => $result['ci'],
            'cr'          => $result['cr'],
            'consistent'  => $result['consistent'],
            'ahpResult' => $result
        ]);

        // $criterias = Criteria::all();

        // $comparisons = ComparisonMatrix::all();

        // $ahpResult = (new AhpService())->calculate();
        // return view('Ahp.test', compact('criterias','comparisons','ahpResult'));

    }
}
