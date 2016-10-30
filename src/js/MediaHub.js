
class Parents {
    constructor(name, age) {
        this.name = name;
        this.age = age;
    }

    sayName() {
        console.log(this.name);
    }
}

class Child extends Parents {
    constructor(name, age) {
        super(name, age);
    }

    // Override the someClass method above
    sayName() {
        // This will call someClass.sayName() triggering the old alert
        // Which will just display our name
        super.sayName();

        // This will trigger the new alert which has labels and our age
        console.log('Name:' + this.name + ' Age:' + this.age);
    }
}

export default Child;