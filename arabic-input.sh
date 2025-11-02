#!/bin/bash

# Interactive Arabic input helper
# This script lets you type Arabic normally and automatically reverses it

echo "======================================"
echo "Arabic Input Helper (RTL Fix)"
echo "======================================"
echo ""
echo "Type your Arabic text normally below."
echo "Press Ctrl+D when done, or Ctrl+C to cancel."
echo ""
echo "Your text:"
echo "--------------------------------------"

# Read input from user
input=$(cat)

# Reverse the text
reversed=""
len=${#input}
for ((i=len-1; i>=0; i--)); do
    reversed="${reversed}${input:$i:1}"
done

echo "--------------------------------------"
echo ""
echo "Reversed text (copy this):"
echo "$reversed"
echo ""
echo "======================================"
