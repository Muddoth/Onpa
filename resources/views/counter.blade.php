<x-layout>
    <style>
        #app {
            font-family: Arial, sans-serif;
            font-size: 40px;
            text-align: center;
            background: #6d6d6d;
            padding: 20px;
            padding-inline: 70px;
            color: white;
            border-radius: 10%;
            width: fit-content;

        }

        button {
            font-size: 24px;
            padding: 10px 20px;
            margin: 5px;
            cursor: pointer;
            background-color: white;
            border: none;
            border-radius: 50%;
            color: #333;
            transition: background-color 0.3s ease, color 0.3s ease, transform 0.2s ease;
        }

        button:hover {
            background-color: #86517f;
            /* green */
            color: white;
            transform: scale(1.1);
            /* slight grow */
        }


        .container {
            display: flex;
            justify-content: center;
            /* center horizontally */
            margin-top: 50px;
        }
    </style>

    <div class="container">
        <div id="app">
            <p>
            <h3>Wishes:</h3>@{{ counter }}</p>
            <p>
            <h3>Doubled:</h3>@{{ doubleCount }}</p>
            <button @click="increment">+</button>
            <button @click="decrement">-</button>
        </div>

    </div>

    @push('scripts')
        
        <script>
            const {
                createApp
            } = Vue;

            createApp({
                data() {
                    return {
                        counter: 0
                    }
                }, // <-- comma here
                methods: { //DOESNT NEED RETURN VALUE
                    increment() {
                        this.counter++;
                    },
                    decrement() {
                        this.counter--;
                    }
                },
                computed: {
                    doubleCount() { //NEEDS RETURN VALUE
                        return this.counter * 2;
                    }
                },
                watch: {
                    counter(newVal) {
                        console.log('Count is now', newVal);

                    }
                },
                mounted() {
                    console.log('Component is mounted');
                }

            }).mount("#app")
        </script>
    @endpush
</x-layout>
