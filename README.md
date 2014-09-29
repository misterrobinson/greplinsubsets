greplinsubsets
==============

Optimized solution for Greplin Challenge 3

The commonly posted solutions for Greplin Challenge 3 are not fully optimized. This repo includes a PHP script that demonstrates the common (sub-optimal) approach, and an optimized approach that executes in roughly half the time. 

For more information on Greplin Challenge 3, please see:

http://stackoverflow.com/questions/6353218/subset-problem-greplin-challenge 

TYPICAL APPROACH:

The typical approach is to create a recursive function to identify all subset sums that equal a given input sum, then call that function once for each of the target sums in the oringal integer set. This results in the same sum operation being performed repeatedly -- potentially many thousands of times depending on the data set. And because recursion is used, each repeated sum operation includes a function call with all associated overhead. 

OPTIMIZED APPROACH:

The optimized approach is to pass over the integer array only once, to calculate and remember all RELEVANT candidate sums -- that is, all subset sums less than the maximum value in the array.  Each of the branches of the recursive sum searching algorithm will terminate as soon as they reach a sum greater than the maximum target sum. This further optimizes the algorithm by avoiding uneccessary function calls and sum operations. 

Once an array of relevant candidate sums has been assembled, that array of subset sums can be efficiently compared against the original input array to determine the total number of subset sums that are equal to one of the members of the original set. 

The optimized script in this repo includes a few extra tweaks that have been empirically tested to prove they increase execution speed. For example, rather than passing the arrays as parameters to the sum-finding function, the arrays are globals. While the use of globals is to be discouraged generally, in this case they actually have a measurable impact on execution speed. The recursive sum function will be called many thousands of times, so it needs to be kept as minimal and efficient as possible. Consequently, in general, everything that CAN be done outside that function IS done outside that function.
