function reduceChildListMutation(mutationContent, record) {
    const isAdded = Boolean(record.addedNodes.length);
    const isNext = Boolean(record.nextSibling);
    const isPrev = Boolean(record.previousSibling);
    const isRemoved = Boolean(record.removedNodes.length);

    // innerHTML or replace
    if (isAdded && (isRemoved || (!isRemoved && !isNext && !isPrev))) {
        while (mutationContent.firstChild) {
            mutationContent.removeChild(mutationContent.firstChild);
        }

        forEach(record.addedNodes, function (node) {
            mutationContent.appendChild(node);
        });

    // appendChild
    } else if (isAdded && !isRemoved && !isNext && isPrev) {
        forEach(record.addedNodes, function (node) {
            mutationContent.appendChild(node);
        });

    // insertBefore
    } else if (isAdded && !isRemoved && isNext && !isPrev) {
        forEach(record.addedNodes, function (node) {
            mutationContent.insertBefore(node, mutationContent.firstChild);
        });
    }

    return mutationContent;
}