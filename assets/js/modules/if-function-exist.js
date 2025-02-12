function ifFunctionExist(functionName, ...args) {
    // Check if the function exists and is callable
    if (typeof window[functionName] === 'function') {
        window[functionName](...args);
    } else {
        console.log(`Function ${functionName} does not exist.`);
    }
}