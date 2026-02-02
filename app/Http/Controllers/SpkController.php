<?php

namespace App\Http\Controllers;

use App\Services\AhpService;

class SpkController extends Controller
{
    public function testAhp(AhpService $ahp)
    {

        try {
            $result = $ahp->calculate();

            return view('Template.Criteria.ahpCounting', [
                'matrix' => $result['matrix'],
                'normalized' => $result['normalized'],
                'weights' => $result['weights'],
                'lambda_max' => $result['lambdaMax'],
                'ci' => $result['ci'],
                'cr' => $result['cr'],
                'consistent' => $result['consistent'],
                'ahpResult' => $result,
            ]);

        } catch (\Exception $e) {
            // Tangkap error dari service, lalu redirect di sini
            return redirect('/comparison-matrix')->with('errorMatrix', $e->getMessage());
        }
    }
}
