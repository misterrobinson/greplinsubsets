greplinsubsets
==============

Optimized solution for Greplin Challenge 3

The commonly posted solutions for Greplin Challenge 3 are not fully optimized. This repo includes a PHP script that demonstrates the common (sub-optimal) approach, and an optimized approach that executes in roughly half the time. 

The Greplin Challenge 3 problem is as follows:

  Given an array of integers, you must find the number of subsets in the array where the largest number is the sum of     the remaining numbers. For example, for array [1, 2, 3, 4, 6] the subsets are: 

    1 + 2 = 3
    1 + 3 = 4
    2 + 4 = 6
    1 + 2 + 3 = 6

  So the answer is 4. There are 4 subsets that match the desired pattern. The program does not need to remember or        printout the relevant subsets -- just the correct count of subsets that match the requirements. In Greplin Challenge 3, the programmer must write analgorithm to find the correct number of subsets given the input array of:
  [3, 4, 9, 14, 15, 19, 28, 37, 47, 50, 54, 56, 59, 61, 70, 73, 78, 81, 92, 95, 97, 99]
 

TYPICAL APPROACH:

The typical approach is to create a recursive function to identify all subset sums that equal a given input sum, then call that function once for each of the target sums in the oringal integer set. THis results in the same sum operation being performed repeatedly -- potentially thousands of times depending on the data set. And because recursion is used, each repeated sum operation includes a function call with all associated overhead. 

OPTIMIZED APPROACH:

The optimized approach is to pass through the integer array only once, to calculate and remember all RELEVANT candidate sums -- that is, all subset sums less than the maximum value in the array.  Each of the branches of the recursive sum searching algorithm will terminate as soon as they reach a sum greater than the maximum target sum. This further optimizes the algorithm by avoiding uneccessary function calls and sum operations. 

Once an array of relevant candidate sums has been assembled, that array ofsubset sums can be efficiently compared against the original inut array to determine the total number of subset sums that are equal to one of the members of the original set. 

The optimized script in this repo includes a few extra tweaks that have been empirically tested to prove they increase execution speed. For example, rather than passing the arrays as parameters to the sum-finding function, the arrays are globals. While the use of globals is to be discouraged generally, in this case they actually have a measurable impact on execution speed. The recursive sum function will be called many thousands of times, so it needs to be kept as minimal and efficient as possible. Consequently, in general, everything that CAN be done outside that function IS done outside that function.
