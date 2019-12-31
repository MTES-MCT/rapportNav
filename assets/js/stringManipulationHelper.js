const snakeToCamel = (s) => {
    return s.replace(/([-_][a-z])/ig, ($1) => {
        return $1.toUpperCase()
            .replace('-', '')
            .replace('_', '');
    });
};

const camelToSnake = (s) => {
    return s.replace(/([A-Z])/g, ($1) => {return "_"+$1.toLowerCase()});
};

const camelToKebab = (s) => {
    return s.replace(/([A-Z])/g, ($1) => {return "-"+$1.toLowerCase()});
};

export {snakeToCamel, camelToSnake, camelToKebab}