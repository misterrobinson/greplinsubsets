<?php 

// Script to demonstrate more optimized solution to Greplin Challenge 3  

	// Function to calculate all subset sums of $inputArray that equal $element
	function findMatchingSums($element, $index)
	{
		global $inputArray;
		global $candidateSums;
		global $nSums;

		$value= $inputArray[$index];

		if($element == $value)
			$nSums++;
		else if($element > $value) // didn't match yet, fork 2 more searches
	      return findMatchingSums($element-$value,$index+1) + findMatchingSums($element,$index+1);

		return; // $element found OR $element < $value
	}


	// function to find all subset sums in $inputArray that are less than $maxSum
 	function findCandidateSums($maxSum, $currentSum, $startIndex, $end)  
	{
		global $inputArray;
		global $candidateSums;

		$newSum= $currentSum + $inputArray[$startIndex];

		 // If we have not passed the max yet on this branch or finished the array...
		if($newSum <= $maxSum) 
		{
			array_push($candidateSums, $newSum); // save this sum and branch 2 searches
			if($startIndex < $end)
			{
				findCandidateSums($maxSum, $currentSum, $startIndex+1, $end); 
				findCandidateSums($maxSum, $newSum, $startIndex+1, $end);  
			}
		}
		return;
	}


	// Main Script -- try both methods and report results

	$inputArray= array( 3, 4, 9, 14, 15, 19, 28, 37, 47, 50, 54, 56, 59, 61, 70, 73, 78, 81, 92, 95, 97, 99);
	$candidateSums= array();
	$nSums= 0;

	// sorting the array first helps us avoid calculating sums > max($inputArray)
	sort($inputArray);

	// Try method A (NON-OPTIMIZED)
	$startTime= microtime(true);  // benchmarking to test optimization
	foreach ($inputArray as $element)  // loop to find subsets for each element
		findMatchingSums($element, 0);

	$nSums-= count($inputArray); // nSums includes one match for each $element
	$elapsedTime= microtime(true) - $startTime;
	print "$nSums valid subsets found in $elapsedTime secs\n";


	// Now Reset sum counter and try method B (OPTIMIZED)
	$nSums= 0;
	$nExecutes= 0;
	$startTime= microtime(true);  // benchmarking to test optimization

	// Go calculate all relevant subset sums 
	findCandidateSums(max($inputArray), 0, 0, count($inputArray)-2);

	// We have an array with all candidate sums, see how many matches there are
	foreach ($candidateSums as $element)
	{
		if(in_array($element, $inputArray))
			$nSums++;
	}
	$nSums-= count($inputArray)-1; // candidateSums includes n-1 elements of inputArray
	$elapsedTime= microtime(true) - $startTime;
	print "$nSums valid subsets found in $elapsedTime secs\n";

 ?> 
